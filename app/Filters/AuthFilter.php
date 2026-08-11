<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan masuk untuk melanjutkan.');
        }

        $user = (new UserModel())->select('id, name, email, role, is_active')
            ->find((int) session('user_id'));

        if ($user === null || ! (bool) $user['is_active']) {
            session()->destroy();

            return redirect()->to('/login')->with('error', 'Sesi berakhir atau akun telah dinonaktifkan.');
        }

        session()->set([
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
