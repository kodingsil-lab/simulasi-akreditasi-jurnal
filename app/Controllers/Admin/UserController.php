<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends BaseController
{
    public function index(): string
    {
        $users = db_connect()->table('users')
            ->select('users.*, COUNT(journal_admins.id) AS journal_count', false)
            ->join('journal_admins', 'journal_admins.user_id = users.id', 'left')
            ->where('users.role', 'admin_jurnal')
            ->groupBy('users.id')
            ->orderBy('users.name')
            ->get()->getResultArray();

        return view('admin/users/index', ['title' => 'Pengguna', 'users' => $users]);
    }

    public function toggleStatus(int $id)
    {
        $users = new UserModel();
        $user = $users->where('id', $id)->where('role', 'admin_jurnal')->first();
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $users->update($id, ['is_active' => ! (bool) $user['is_active']]);
        log_message('notice', 'Operator sistem mengubah status user {user} menjadi {status}', [
            'user' => $id, 'status' => $user['is_active'] ? 'nonaktif' : 'aktif',
        ]);

        return redirect()->to('/admin/admin-jurnal')->with('success', 'Status akun admin jurnal berhasil diubah.');
    }
}
