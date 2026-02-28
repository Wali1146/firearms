<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterOrdersStatus extends Migration
{
    public function up()
    {
        $fields = [
            'status'=>[
                'type'=>"enum('pending','processing','shipped','completed','cancelled')"
            ]
        ];
        $this->forge->modifyColumn('orders', $fields);
    }

    public function down()
    {
        $fields=[
            'status'=>[
                'type'=>"enum('pending','processing','shipped','completed')"
            ]
        ];
        $this->forge->modifyColumn('orders', $fields);
    }
}
