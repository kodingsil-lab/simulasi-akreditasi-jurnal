<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use RuntimeException;

class LeksikonDummySeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $adminEmail = strtolower(trim((string) env('seed.adminEmail')));

        if (! filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Isi seed.adminEmail pada .env dengan email admin jurnal yang akan menerima data demo.');
        }

        $admin = $this->db->table('users')
            ->where('email', $adminEmail)
            ->get()->getRowArray();

        if ($admin === null) {
            throw new RuntimeException('Akun admin jurnal untuk data demo belum tersedia.');
        }

        $journal = $this->db->table('journals')->where('slug', 'leksikon')->get()->getRowArray();

        if ($journal === null) {
            $this->db->table('journals')->insert([
                'name'                 => 'LEKSIKON: Jurnal Pendidikan Bahasa, Sastra, & Budaya',
                'slug'                 => 'leksikon',
                'e_issn'               => '3025-1516',
                'website_url'          => 'https://ejurnal-unisap.ac.id/index.php/leksikon',
                'publisher'            => 'UPT Publikasi dan Penerbitan Universitas San Pedro',
                'scope'                => 'Publikasi artikel hasil kajian teoretis dan penelitian empiris di bidang pendidikan bahasa, linguistik, pendidikan bahasa Indonesia, BIPA, bahasa asing, kesusastraan, pendidikan dan pengajaran sastra, kebudayaan, serta seni.',
                'frequency'            => '2 kali setahun (April dan Oktober)',
                'first_published_year' => 2023,
                'doi_prefix'           => '10.59632',
                'is_active'            => 1,
                'created_at'           => $now,
                'updated_at'           => $now,
            ]);
            $journalId = (int) $this->db->insertID();
        } else {
            $journalId = (int) $journal['id'];
        }

        if (! $this->db->table('journal_admins')->where([
            'journal_id' => $journalId,
            'user_id'    => $admin['id'],
        ])->countAllResults()) {
            $this->db->table('journal_admins')->insert([
                'journal_id' => $journalId,
                'user_id'    => $admin['id'],
                'created_at' => $now,
            ]);
        }

        if (! $this->db->table('evaluations')->where([
            'journal_id'  => $journalId,
            'period_year' => 2026,
        ])->countAllResults()) {
            $version = $this->db->table('rubric_versions')->where('is_active', 1)->orderBy('id', 'DESC')->get()->getRowArray();
            $this->db->table('evaluations')->insert([
                'journal_id'        => $journalId,
                'period_year'       => 2026,
                'created_by'        => $admin['id'],
                'rubric_version_id' => $version['id'] ?? null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ]);
        }
    }
}
