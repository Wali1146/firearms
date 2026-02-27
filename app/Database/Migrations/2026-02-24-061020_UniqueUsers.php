<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UniqueUsers extends Migration
{
    public function up()
    {
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->processIndexes('users');
    }

    public function down()
    {
        $this->forge->dropKey('users','username_unique');
        $this->forge->dropKey('users','email_unique');
    }
}
