<?php

namespace Tests\Security;

use App\Services\JournalAccessService;
use CodeIgniter\Test\CIUnitTestCase;

final class JournalAccessServiceTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->db = db_connect();
        $forge = \Config\Database::forge($this->db);

        foreach (['evaluations', 'journal_admins', 'journals'] as $table) {
            $forge->dropTable($table, true);
        }

        $forge->addField(['id' => ['type' => 'INTEGER'], 'name' => ['type' => 'VARCHAR', 'constraint' => 100]]);
        $forge->addKey('id', true);
        $forge->createTable('journals');
        $forge->addField(['id' => ['type' => 'INTEGER'], 'journal_id' => ['type' => 'INTEGER'], 'user_id' => ['type' => 'INTEGER']]);
        $forge->addKey('id', true);
        $forge->createTable('journal_admins');
        $forge->addField(['id' => ['type' => 'INTEGER'], 'journal_id' => ['type' => 'INTEGER']]);
        $forge->addKey('id', true);
        $forge->createTable('evaluations');

        $this->db->table('journals')->insertBatch([
            ['id' => 1, 'name' => 'Jurnal Admin Satu'],
            ['id' => 2, 'name' => 'Jurnal Admin Dua'],
        ]);
        $this->db->table('journal_admins')->insertBatch([
            ['id' => 1, 'journal_id' => 1, 'user_id' => 10],
            ['id' => 2, 'journal_id' => 2, 'user_id' => 20],
        ]);
        $this->db->table('evaluations')->insertBatch([
            ['id' => 101, 'journal_id' => 1],
            ['id' => 202, 'journal_id' => 2],
        ]);
    }

    protected function tearDown(): void
    {
        $forge = \Config\Database::forge($this->db);
        foreach (['evaluations', 'journal_admins', 'journals'] as $table) {
            $forge->dropTable($table, true);
        }
        parent::tearDown();
    }

    public function testAdminOnlyAccessesAssignedJournal(): void
    {
        $service = new JournalAccessService();

        $this->assertTrue($service->canAccessJournal(10, 1, 'admin_jurnal'));
        $this->assertFalse($service->canAccessJournal(10, 2, 'admin_jurnal'));
        $this->assertFalse($service->canAccessJournal(20, 1, 'admin_jurnal'));
    }

    public function testAdminCannotAccessOtherAdminsEvaluation(): void
    {
        $service = new JournalAccessService();

        $this->assertTrue($service->canAccessEvaluation(10, 101, 'admin_jurnal'));
        $this->assertFalse($service->canAccessEvaluation(10, 202, 'admin_jurnal'));
        $this->assertFalse($service->canAccessEvaluation(10, 999, 'admin_jurnal'));
    }

    public function testSystemOperatorCannotReadJournalsOrEvaluations(): void
    {
        $service = new JournalAccessService();

        $this->assertFalse($service->canAccessJournal(1, 1, 'super_admin'));
        $this->assertFalse($service->canAccessJournal(1, 2, 'super_admin'));
        $this->assertFalse($service->canAccessEvaluation(1, 202, 'super_admin'));
        $this->assertFalse($service->canAccessEvaluation(1, 999, 'super_admin'));
    }
}
