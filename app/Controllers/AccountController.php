<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AccountController extends BaseController
{
    public function edit(): string
    {
        $user = (new UserModel())->find((int) session('user_id'));
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('account/edit', ['title' => 'Pengaturan Akun', 'user' => $user]);
    }

    public function update()
    {
        $users = new UserModel();
        $userId = (int) session('user_id');
        $user = $users->find($userId);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name'             => 'required|min_length[3]|max_length[120]',
            'email'            => 'required|valid_email|max_length[191]',
            'current_password' => 'required|max_length[72]',
        ];
        $newPassword = (string) $this->request->getPost('new_password');
        if ($newPassword !== '') {
            $rules['new_password'] = 'required|min_length[8]|max_length[72]';
            $rules['new_password_confirm'] = 'required|matches[new_password]';
        }

        if (! $this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! password_verify((string) $this->request->getPost('current_password'), $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Kata sandi saat ini tidak sesuai.');
        }

        $email = strtolower(trim((string) $this->request->getPost('email')));
        $duplicate = $users->where('email', $email)->where('id !=', $userId)->first();
        if ($duplicate !== null) {
            return redirect()->back()->withInput()->with('error', 'Email sudah digunakan oleh akun lain.');
        }

        $payload = [
            'name'  => trim((string) $this->request->getPost('name')),
            'email' => $email,
        ];
        if ($newPassword !== '') {
            $payload['password_hash'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if (! $users->update($userId, $payload)) {
            return redirect()->back()->withInput()->with('error', 'Pengaturan akun gagal disimpan.');
        }

        session()->set(['name' => $payload['name'], 'email' => $payload['email']]);
        if ($newPassword !== '') {
            session()->regenerate(true);
        }
        log_message('notice', 'Pengguna {user} memperbarui pengaturan akun', ['user' => $userId]);

        return redirect()->to('/akun')->with('success', 'Pengaturan akun berhasil diperbarui.');
    }
}
