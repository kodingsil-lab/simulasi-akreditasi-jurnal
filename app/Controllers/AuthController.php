<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login(): string
    {
        return view('auth/login', ['title' => 'Masuk']);
    }

    public function register(): string
    {
        return view('auth/register', ['title' => 'Registrasi']);
    }

    public function attempt()
    {
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $throttleKey = 'login-' . hash('sha256', $this->request->getIPAddress() . '|' . $email);
        $throttler = service('throttler');

        if (! $throttler->check($throttleKey, 5, 300, 1)) {
            log_message('warning', 'Percobaan login berlebihan dari IP {ip}', ['ip' => $this->request->getIPAddress()]);

            return redirect()->back()->withInput()->with('error', 'Terlalu banyak percobaan masuk. Tunggu beberapa menit lalu coba kembali.');
        }

        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = (new UserModel())->where('email', $email)->first();

        if ($user === null || ! $user['is_active'] || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
            log_message('notice', 'Login gagal untuk identitas {identity} dari IP {ip}', [
                'identity' => hash('sha256', $email), 'ip' => $this->request->getIPAddress(),
            ]);
            return redirect()->back()->withInput()->with('error', 'Email atau kata sandi tidak sesuai.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id'      => $user['id'],
            'name'         => $user['name'],
            'email'        => $user['email'],
            'role'         => $user['role'],
            'is_logged_in' => true,
        ]);

        return redirect()->to('/');
    }

    public function storeRegistration()
    {
        $rules = [
            'username'         => 'required|min_length[3]|max_length[80]',
            'email'            => 'required|valid_email|max_length[191]|is_unique[users.email]',
            'password'         => 'required|min_length[8]|max_length[72]',
            'password_confirm' => 'required|matches[password]',
        ];
        $messages = [
            'username' => [
                'required'   => 'Username wajib diisi.',
                'min_length' => 'Username minimal 3 karakter.',
                'max_length' => 'Username maksimal 80 karakter.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email sudah digunakan oleh akun lain.',
            ],
            'password' => [
                'required'   => 'Kata sandi wajib diisi.',
                'min_length' => 'Kata sandi minimal 8 karakter.',
                'max_length' => 'Kata sandi maksimal 72 karakter.',
            ],
            'password_confirm' => [
                'required' => 'Konfirmasi kata sandi wajib diisi.',
                'matches'  => 'Konfirmasi kata sandi tidak sama.',
            ],
        ];

        if (! $this->validateData($this->request->getPost(), $rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'name'          => trim((string) $this->request->getPost('username')),
            'email'         => strtolower(trim((string) $this->request->getPost('email'))),
            'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'admin_jurnal',
            'is_active'     => 1,
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan masuk menggunakan akun Anda.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Anda telah keluar.');
    }
}
