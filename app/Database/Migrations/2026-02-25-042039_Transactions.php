<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
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
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'default' => NULL
            ],
            'amount' => [
                'type' => 'decimal',
                'constraint' => '10,2',
                'null' => FALSE,
            ],
            'method' => [
                'type' => 'varchar',
                'constraint' => '50',
                'null' => TRUE,
                'default' => 'credit_card',
            ],
            'status' => [
                'type' => "enum('pending','completed','refunded','failed')",
                'null' => TRUE,
                'default' => 'completed'
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('transactions');
        $this->db->enableForeignKeyChecks();
    }
}
