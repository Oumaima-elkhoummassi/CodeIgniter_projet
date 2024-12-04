<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePost extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'blodescription' => [
                'type' => 'TEXT'
               
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('post');
    }

    public function down()
    {
        //
        $this->forge->dropTable('post');
    }
}
