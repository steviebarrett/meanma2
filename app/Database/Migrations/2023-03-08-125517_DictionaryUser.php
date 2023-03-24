<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DictionaryUser extends Migration
{
    public function up()
    {
	    $this->forge->addField([
		    'user_id' => [
			    'type'          => 'INT',
			    'constraint'    => 11,
			    'unsigned'      => true,
			    'null'          => false
		    ],
		    'dictionary_id' => [
			    'type'          => 'INT',
			    'constraint'    => 5,
				'unsigned'      => true,
			    'null'          => false
		    ],
		    'access_level' => [
				'type'          => 'INT',
			    'constraint'    => 3,
			    'unsigned'      => true,
			    'default'       => '10'
		    ]
	    ]);

	    $this->forge->addForeignKey('dictionary_id', 'dictionary', 'id', 'CASCADE', 'CASCADE', 'dictionary_id_fk');
	    $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE', 'user_id_fk');

	    $this->forge->addPrimaryKey(['dictionary_id', 'user_id'], 'du_pk');

	    $this->forge->createTable('dictionary_user');
    }

    public function down()
    {
        $this->forge->dropTable('dictionary_user');
    }
}
