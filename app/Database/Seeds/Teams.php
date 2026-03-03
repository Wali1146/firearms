<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Teams extends Seeder
{
    public function run()
    {
        $data=[
            [
                'name'=>'John Rhys'
            ],
            [
                'name'=>'Sarah Chen'
            ],
            [
                'name'=>'Michael Rodriguez'
            ]
        ];
        $this->db->table('teams')->insertBatch($data);
    }
}
