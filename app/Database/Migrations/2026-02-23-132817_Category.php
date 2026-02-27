<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ],
            'sort_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('category');
    }

    public function down()
    {
        $this->forge->dropTable('category');
    }
}
