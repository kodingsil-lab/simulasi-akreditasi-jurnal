<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Config\Rubric2026;

class RubricSeeder extends Seeder
{
    public function run()
    {
        $rubric = new Rubric2026();
        $this->db->transStart();

        foreach ($rubric->items as $index => $definition) {
            $code = (string) $index;
            $item = $this->db->table('rubric_items')->where('code', $code)->get()->getRowArray();
            $values = [
                'category'   => substr($code, 0, 1),
                'label'      => $definition['label'],
                'max_score'  => $definition['max'],
                'sort_order' => array_search($code, array_keys($rubric->items), true) + 1,
            ];

            if ($item === null) {
                $this->db->table('rubric_items')->insert(['code' => $code] + $values);
                $itemId = (int) $this->db->insertID();
            } else {
                $itemId = (int) $item['id'];
                $this->db->table('rubric_items')->where('id', $itemId)->update($values);
                $this->db->table('rubric_options')->where('rubric_item_id', $itemId)->delete();
            }

            foreach ($definition['options'] as [$score, $indicator]) {
                $this->db->table('rubric_options')->insert([
                    'rubric_item_id' => $itemId,
                    'score'          => $score,
                    'indicator'      => $indicator,
                ]);
            }
        }

        if ($this->db->tableExists('rubric_versions')) {
            $version = $this->db->table('rubric_versions')->where('is_active', 1)->orderBy('id', 'DESC')->get()->getRowArray();
            if ($version === null) {
                $this->db->table('rubric_versions')->insert([
                    'name'       => $rubric->name,
                    'reference'  => $rubric->reference,
                    'is_active'  => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            } else {
                $this->db->table('rubric_versions')->where('id', $version['id'])->update([
                    'name'      => $rubric->name,
                    'reference' => $rubric->reference,
                ]);
            }
        }

        $this->db->transComplete();
    }
}
