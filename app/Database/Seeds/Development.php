<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Development extends Seeder
{
	public function run()
	{
		$users = [
			[
				'firstname' => 'Stevie',
				'lastname' => 'Barrett',
				'email' => 'mail@steviebarrett.com',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1',
				'is_superuser' => '1'
			],
			[
				'firstname' => 'Mark',
				'lastname' => 'McConville',
				'email' => 'Mark.McConville@glasgow.ac.uk',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1',
				'is_superuser' => '1'
			],
			[
				'firstname' => 'Charlie',
				'lastname' => 'Dillon',
				'email' => 'C.Dillon@ria.ie',
				'password_hash' => '$2y$10$qZkXbuPvPBrkDgZDsbyk.eY/S0jUcd879MbR9v61iRc.E.5AwvwgW',
				'is_active' => '1'
			],
		];

		$builder = $this->db->table('user');

		foreach ($users as $user) {
			$builder->insert($user);
		}

		$dictionaries = [
			['name' => 'Faclair na Gàidhlig', 'short_name' => 'Faclair'],
			['name' => 'Foclóir Stairiúil na Gaeilge', 'short_name' => 'Foclóir']
		];

		$builder = $this->db->table('dictionary');

		foreach ($dictionaries as $dictionary) {
			$builder->insert($dictionary);
		}

		$dictionaryUsers = [
			['user_id' => '1', 'dictionary_id' => '1', 'access_level' => '70'],
			['user_id' => '1', 'dictionary_id' => '2', 'access_level' => '10'],
			['user_id' => '2', 'dictionary_id' => '1', 'access_level' => '70'],
			['user_id' => '2', 'dictionary_id' => '2', 'access_level' => '10'],
			['user_id' => '3', 'dictionary_id' => '2', 'access_level' => '70'],
		];

		$builder = $this->db->table('dictionary_user');

		foreach ($dictionaryUsers as $dictionaryUser) {
			$builder->insert($dictionaryUser);
		}
	}
}
