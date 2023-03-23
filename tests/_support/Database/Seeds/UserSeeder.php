<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$users = [
			[
				'firstname' => 'Dictionary 1',
				'lastname' => 'Admin',
				'email' => 'steviebuzz+admin@gmail.com',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1',
			],
			[
				'firstname' => 'Dictionary 2',
				'lastname' => 'Editor',
				'email' => 'steviebuzz+editor@gmail.com',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1'
			],
			[
				'firstname' => 'Dictionary 3',
				'lastname' => 'User',
				'email' => 'steviebuzz+user@gmail.com',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1'
			],
			[
				'firstname' => 'Super',
				'lastname' => 'User',
				'email' => 'steviebuzz+super@gmail.com',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1',
				'is_superuser' => '1'
			],
		];

		$builder = $this->db->table('user');

		foreach ($users as $user) {
			$builder->insert($user);
		}
	}
}
