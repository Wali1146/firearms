<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrderItems extends Migration
{
    /** @var \CodeIgniter\Database\BaseConnection $db */
    protected $db;

    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ],
            'order_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE
            ],
            'product_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE
            ],
            'quantity'=>[
                'type'=>'INT',
                'constraint'=>11,
                'null'=>FALSE
            ],
            'price'=>[
                'type'=>'decimal',
                'constraint'=>'10,2',
                'null'=>FALSE
            ],
            'created_at'=>[
                'type'=>'timestamp',
                'null'=>FALSE
            ]
        ]);
        $this->forge->addKey('id',TRUE);
        $this->forge->addForeignKey('order_id','orders','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('product_id','products','id','CASCADE','CASCADE');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->dropTable('order_items');
        $this->db->enableForeignKeyChecks();
    }
}
