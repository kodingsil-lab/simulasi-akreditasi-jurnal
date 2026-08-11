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

        if (! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
            throw new RuntimeException('Isi seed.adminEmail dan seed.adminPassword (minimal 8 karakter) pada .env sebelum menjalankan UserSeeder.');
        }

        if ($this->db->table('users')->where('email', $email)->countAllResults()) {
            return;
        }

        $this->db->table('users')->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => 'admin_jurnal',
            'is_active'     => true,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}
