<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJournalProfileFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('journals', [
            'e_issn'               => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'after' => 'slug'],
            'website_url'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'e_issn'],
            'publisher'            => ['type' => 'VARCHAR', 'constraint' => 191, 'null' => true, 'after' => 'website_url'],
            'scope'                => ['type' => 'TEXT', 'null' => true, 'after' => 'publisher'],
            'frequency'            => ['type' => 'VARCHAR', 'constraint' => 80, 'null' => true, 'after' => 'scope'],
            'first_published_year' => ['type' => 'SMALLINT', 'unsigned' => true, 'null' => true, 'after' => 'frequency'],
            'doi_prefix'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true, 'after' => 'first_published_year'],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('journals', ['e_issn', 'website_url', 'publisher', 'scope', 'frequency', 'first_published_year', 'doi_prefix']);
    }
}
