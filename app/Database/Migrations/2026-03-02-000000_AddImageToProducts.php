<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToProducts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('products', [
            'image' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => TRUE,
                'default' => NULL,
                'after' => 'description'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'image');
    }
}
