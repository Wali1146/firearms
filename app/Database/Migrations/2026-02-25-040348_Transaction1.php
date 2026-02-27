<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction1 extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'default' => 1
            ],
            'status' => [
                'type' => "enum('cart','purchased')",
                'null' => TRUE,
                'default' => 'cart'
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('transaction');
        $this->db->enableForeignKeyChecks();
    }
}
