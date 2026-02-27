<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => FALSE
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('teams');
    }

    public function down()
    {
        $this->forge->dropTable('teams');
    }
}
