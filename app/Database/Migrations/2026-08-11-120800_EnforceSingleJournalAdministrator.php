<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use RuntimeException;

class EnforceSingleJournalAdministrator extends Migration
{
    public function up()
    {
        $duplicates = $this->db->table('journal_admins')
            ->select('journal_id, COUNT(*) AS total', false)
            ->groupBy('journal_id')
            ->having('COUNT(*) >', 1)
            ->get()->getResultArray();

        if ($duplicates !== []) {
            throw new RuntimeException('Terdapat jurnal dengan lebih dari satu admin. Rapikan penugasan sebelum menjalankan migrasi.');
        }

        $this->db->query('ALTER TABLE journal_admins ADD CONSTRAINT uq_journal_admins_journal UNIQUE (journal_id)');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE journal_admins DROP INDEX uq_journal_admins_journal');
    }
}
