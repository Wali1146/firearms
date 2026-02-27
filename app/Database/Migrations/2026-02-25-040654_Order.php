<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
            'total' => [
                'type' => 'decimal',
                'constraint' => '10,2',
                'null' => FALSE
            ],
            'status' => [
                'type' => "enum('pending','processing','shipped','complete')",
                'null' => TRUE,
                'default' => 'pending'
            ],
            'shipping_name' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => TRUE,
                'default' => NULL
            ],
            'shipping_email' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => TRUE,
                'default' => NULL
            ],
            'shipping_address' => [
                'type' => 'text',
                'null' => TRUE,
                'default' => NULL
            ],
            'shipping_city' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => TRUE,
                'default' => NULL
            ],
            'shipping_state' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => TRUE,
                'default' => NULL
            ],
            'shipping_zip' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => TRUE,
                'default' => NULL
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => FALSE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('orders');
        $this->db->enableForeignKeyChecks();
    }
}
