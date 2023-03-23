<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dictionary extends Migration
{
    public function up()
    {
        $this->forge->addField([
	        'id' => [
			    'type'          => 'INT',
			    'constraint'    => 5,
			    'unsigned'      => true,
			    'auto_increment'=> true
		    ],
			'name' => [
			    'type'          => 'VARCHAR',
			    'constraint'    => '255',
				'null'          => false
            ],
			'short_name' => [
				'type'          => 'VARCHAR',
				'constraint'    => '100',
				'null'          => false
            ],
	        'created_at' => [
		        'type'          => 'DATETIME',
		        'null'          => true,
		        'default'       => null
	        ],
	        'updated_at' => [
		        'type'          => 'DATETIME',
		        'null'          => true,
		        'default'       => null
	        ]
        ]);
	    $this->forge->addPrimaryKey('id');
	    $this->forge->createTable('dictionary');
    }

    public function down()
    {
        $this->forge->dropTable('dictionary');
    }
}
