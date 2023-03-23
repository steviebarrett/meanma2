<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'          => 'INT',
				'constraint'    => 11,
				'unsigned'      => true,
				'auto_increment'=> true
			],
			'firstname' => [
				'type'          => 'VARCHAR',
				'constraint'    => '128'
			],
			'lastname' => [
				'type'          => 'VARCHAR',
				'constraint'    => '128'
			],
			'email' => [
				'type'          => 'VARCHAR',
				'constraint'    => '255'
			],
			'password_hash' => [
				'type'          => 'VARCHAR',
				'constraint'    => '255'
			],
			'is_active' => [
				'type'          => 'BOOLEAN',
				'null'          => false,
				'default'       => false
			],
			'is_superuser' => [
				'type'          => 'BOOLEAN',
				'null'          => false,
				'default'       => false
			],
			'reset_hash' => [
				'type'          => 'VARCHAR',
				'constraint'    => '64',
				'unique'        => true,
				'default'       => null
			],
			'reset_expires_at'  => [
				'type'          => 'DATETIME'
			],
			'last_logged_in_at' => [
				'type'          => 'DATETIME',
				'null'          => true,
				'default'       => null
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

		$this->forge->addPrimaryKey('id')
			->addUniqueKey('email');
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
