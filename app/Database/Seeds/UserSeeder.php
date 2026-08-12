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

        if ($this->db->table('users')->where('email', $email)->countAllResults()) {
            return;
        }

        $this->db->table('users')->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role,
            'is_active'     => true,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
