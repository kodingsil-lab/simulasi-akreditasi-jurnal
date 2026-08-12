<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NormalizeEligibilityAndCreateRubrics extends Migration
{
    public function up()
    {
        // DELETE dipakai karena MySQL melarang TRUNCATE pada tabel induk
        // selama foreign key eligibility_answers -> eligibility_items ada.
        $this->db->table('eligibility_answers')->emptyTable();
        $this->db->table('eligibility_items')->emptyTable();

        $items = [
            'Validitas laman jurnal',
            'Validitas nama jurnal sesuai ISSN',
            'Validitas penerbit jurnal sesuai ISSN',
            'Kesesuaian jenis dan waktu usulan',
            'Kesesuaian frekuensi terbitan',
            'Keberkalaan jurnal tiga tahun terakhir',
            'Pencantuman peringkat dan masa berlaku',
            'Laman etika publikasi',
            'Laman biaya pemrosesan artikel',
            'Ketersediaan DOI aktif',
            'Ketersediaan teks penuh pada setiap artikel',
            'Kecukupan keberagaman afiliasi Tim Editor',
            'Kecukupan keberagaman afiliasi Mitra Bestari',
            'Validitas username dan password',
            'Ketersediaan kredensial/peran Editor',
        ];

        foreach ($items as $index => $label) {
            $this->db->table('eligibility_items')->insert([
                'section'    => 'awal',
                'label'      => $label,
                'sort_order' => $index + 1,
            ]);
        }

        $feasibilityItems = [
            'Setiap artikel telah melalui penelaahan oleh Mitra Bestari',
            'Validitas dan integritas penerbit serta kepatuhan etika publikasi',
        ];

        foreach ($feasibilityItems as $index => $label) {
            $this->db->table('eligibility_items')->insert([
                'section'    => 'kelayakan',
                'label'      => $label,
                'sort_order' => $index + 16,
            ]);
        }

        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'code'       => ['type' => 'VARCHAR', 'constraint' => 10],
            'category'   => ['type' => 'CHAR', 'constraint' => 1],
            'label'      => ['type' => 'VARCHAR', 'constraint' => 191],
            'max_score'  => ['type' => 'DECIMAL', 'constraint' => '5,1'],
            'sort_order' => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('code');
        $this->forge->createTable('rubric_items');

        $this->forge->addField([
            'id'             => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'rubric_item_id' => ['type' => 'INT', 'unsigned' => true],
            'score'          => ['type' => 'DECIMAL', 'constraint' => '5,1'],
            'indicator'      => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('rubric_item_id', 'rubric_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rubric_options');

        $this->forge->addField([
            'id'             => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'evaluation_id'  => ['type' => 'BIGINT', 'unsigned' => true],
            'rubric_item_id' => ['type' => 'INT', 'unsigned' => true],
            'score'          => ['type' => 'DECIMAL', 'constraint' => '5,1'],
            'evidence_url'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'notes'          => ['type' => 'TEXT', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['evaluation_id', 'rubric_item_id']);
        $this->forge->addForeignKey('evaluation_id', 'evaluations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rubric_item_id', 'rubric_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rubric_scores');
    }

    public function down()
    {
        $this->forge->dropTable('rubric_scores', true);
        $this->forge->dropTable('rubric_options', true);
        $this->forge->dropTable('rubric_items', true);
    }
}
