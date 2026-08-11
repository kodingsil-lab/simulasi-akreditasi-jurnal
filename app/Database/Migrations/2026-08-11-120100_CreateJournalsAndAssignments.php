<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalsAndAssignments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 191],
            'slug'       => ['type' => 'VARCHAR', 'constraint' => 191],
            'is_active'  => ['type' => 'BOOLEAN', 'default' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('journals');

        $this->forge->addField([
            'id'         => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'journal_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'user_id'    => ['type' => 'BIGINT', 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['journal_id', 'user_id']);
        $this->forge->addForeignKey('journal_id', 'journals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('journal_admins');
    }

    public function down()
    {
        $this->forge->dropTable('journal_admins', true);
        $this->forge->dropTable('journals', true);
    }
}
