<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Config\Rubric2026;

class SyncRubricIndicators2026 extends Migration
{
    public function up()
    {
        $rubric = new Rubric2026();
        $sortOrder = 1;

        foreach ($rubric->items as $code => $definition) {
            $item = $this->db->table('rubric_items')->where('code', $code)->get()->getRowArray();

            if ($item === null) {
                continue;
            }

            $category = substr($code, 0, 1);
            $this->db->table('rubric_items')->where('id', $item['id'])->update([
                'category'   => $category,
                'label'      => $definition['label'],
                'max_score'  => $definition['max'],
                'sort_order' => $sortOrder++,
            ]);

            $this->db->table('rubric_options')->where('rubric_item_id', $item['id'])->delete();

            foreach ($definition['options'] as [$score, $indicator]) {
                $this->db->table('rubric_options')->insert([
                    'rubric_item_id' => $item['id'],
                    'score'          => $score,
                    'indicator'      => $indicator,
                ]);
            }
        }

        if ($this->db->tableExists('rubric_versions')) {
            $version = $this->db->table('rubric_versions')->orderBy('id', 'DESC')->get()->getRowArray();
            if ($version !== null) {
                $this->db->table('rubric_versions')->where('id', $version['id'])->update([
                    'name'      => $rubric->name,
                    'reference' => $rubric->reference,
                ]);
            }
        }
    }

    public function down()
    {
        // Sinkronisasi isi rubrik tidak dibatalkan agar riwayat indikator tetap utuh.
    }
}
