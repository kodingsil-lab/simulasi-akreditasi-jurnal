<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use RuntimeException;

class UserSeeder extends Seeder
{
    public function run()
    {
        $name = trim((string) env('seed.adminName', 'Admin Jurnal'));
        $email = strtolower(trim((string) env('seed.adminEmail')));
        $password = (string) env('seed.adminPassword');
        $role = strtolower(trim((string) env('seed.adminRole', 'admin_jurnal')));

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
            throw new RuntimeException('Isi seed.adminEmail dan seed.adminPassword (minimal 8 karakter) pada .env sebelum menjalankan UserSeeder.');
        }

        if (! in_array($role, ['admin_jurnal', 'super_admin'], true)) {
            throw new RuntimeException('seed.adminRole harus berisi admin_jurnal atau super_admin.');
        }

        $existing = $this->db->table('users')->where('email', $email)->get()->getRowArray();
        $account = [
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role,
            'is_active'     => true,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($existing !== null) {
            $this->db->table('users')->where('id', $existing['id'])->update($account);

            return;
        }

        $this->db->table('users')->insert($account + [
            'created_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
