<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddParametersToEligibilityItems extends Migration
{
    public function up()
    {
        $this->forge->addColumn('eligibility_items', [
            'parameter' => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => true,
                'after'      => 'section',
            ],
        ]);

        $parameters = [
            'Validitas laman jurnal' => 'Pemeriksaan nama dan laman jurnal',
            'Validitas nama jurnal sesuai ISSN' => 'Pemeriksaan nama dan laman jurnal',
            'Validitas penerbit jurnal sesuai ISSN' => 'Pemeriksaan nama dan laman jurnal',
            'Kesesuaian jenis dan waktu usulan' => 'Pemeriksaan usulan',
            'Kesesuaian frekuensi terbitan' => 'Pemeriksaan frekuensi dan keberkalaan',
            'Keberkalaan jurnal tiga tahun terakhir' => 'Pemeriksaan frekuensi dan keberkalaan',
            'Pencantuman peringkat dan masa berlaku' => 'Pemeriksaan frekuensi dan keberkalaan',
            'Laman etika publikasi' => 'Pemeriksaan kelengkapan laman jurnal',
            'Laman biaya pemrosesan artikel' => 'Pemeriksaan kelengkapan laman jurnal',
            'Ketersediaan DOI aktif' => 'Pemeriksaan kelengkapan laman jurnal',
            'Ketersediaan teks penuh pada setiap artikel' => 'Pemeriksaan kelengkapan laman jurnal',
            'Kecukupan keberagaman afiliasi Tim Editor' => 'Pemeriksaan keberagaman afiliasi editor dan mitra bestari',
            'Kecukupan keberagaman afiliasi Mitra Bestari' => 'Pemeriksaan keberagaman afiliasi editor dan mitra bestari',
            'Validitas username dan password' => 'Pemeriksaan kredensial',
            'Ketersediaan kredensial/peran Editor' => 'Pemeriksaan kredensial',
            'Setiap artikel telah melalui penelaahan oleh Mitra Bestari' => 'Kecukupan Penelaahan Artikel oleh Mitra Bestari',
            'Validitas dan integritas penerbit serta kepatuhan etika publikasi' => 'Validitas dan Integritas Penerbit',
        ];

        foreach ($parameters as $label => $parameter) {
            $this->db->table('eligibility_items')->where('label', $label)->update(['parameter' => $parameter]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('eligibility_items', 'parameter');
    }
}
