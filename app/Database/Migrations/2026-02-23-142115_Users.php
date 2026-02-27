<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'username' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => FALSE
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => FALSE
            ],
            'password' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => FALSE
            ],
            'role' => [
                'type' => "enum('user','admin')",
                'default' => 'user',
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
