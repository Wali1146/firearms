<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Category extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'firearms',
                'sort_order' => 0
            ],
            [
                'name' => 'courses',
                'sort_order' => 0
            ],
            [
                'name' => 'subscriptions',
                'sort_order' => 0
            ]
        ];
        $this->db->table('category')->insertBatch($data);
    }
}
