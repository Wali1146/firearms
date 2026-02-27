<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    /** @var \CodeIgniter\Database\BaseConnection $db */
    protected $db;

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
                'constraint' => 255,
                'null' => FALSE
            ],
            'type' => [
                'type' => "enum('subscription','course','firearms')",
                'null' => FALSE
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'team_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'price' => [
                'type' => 'decimal',
                'constraint' => '10,2',
                'null' => FALSE
            ],
            'description' => [
                'type' => 'text',
                'null' => TRUE,
                'default' => NULL
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('category_id', 'category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('team_id', 'teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('products');
        $this->db->enableForeignKeyChecks();
    }
}
