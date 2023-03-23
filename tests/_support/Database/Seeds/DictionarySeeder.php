<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DictionarySeeder extends Seeder
{
	public function run()
	{
		$dictionaries = [
			[
				'name' => 'Dictionary Test 1',
				'short_name' => 'test1'
			],
			[
				'name' => 'Dictionary Test 2',
				'short_name' => 'test2'
			],
			[
				'name' => 'Dictionary Test 3',
				'short_name' => 'test3'
			],
		];

		$builder = $this->db->table('dictionary');
/*
		foreach ($dictionaries as $dictionary) {
			$builder->insert($dictionary);
		}

		$dictionaryUsers = [
			[
				'user_id' => 1,
				'dictionary_id' => 1,
				'access_level' => 70
			],
			[
				'user_id' => 2,
				'dictionary_id' => 2,
				'access_level' => 50
			],
			[
				'user_id' => 3,
				'dictionary_id' => 3,
				'access_level' => 10
			]
		];

		$dictionaryUsers = [

				'user_id' => 1,
				'dictionary_id' => 1,
				'access_level' => 70

		];

		$sql = <<<SQL
			insert into dictionary_user (user_id, dictionary_id, access_level) values(1, 1, 70)
SQL;

		$this->db->query($sql);
*/
	}
}
