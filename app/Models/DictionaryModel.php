<?php

namespace App\Models;

use App\Entities\Dictionary;

/**
 * Class that provides the CRUD methods required to work with the `dictionary` DB table
 */
class DictionaryModel extends \CodeIgniter\Model
{
	protected $table = 'dictionary';

	protected $allowedFields = ['name', 'short_name'];

	protected $returnType = 'App\Entities\Dictionary';

	protected $useTimestamps = true;

	protected $validationRules = [
		'name' => 'required',
		'short_name' => 'required'
	];

	/**
	 * Retrieves a dictionary object with the given dictionary ID
	 * If the optional userID is passed then the access_level for that user is returned also
	 * Otherwise the access level for the current user is returned
	 *
	 * @param $id : the dictionary ID
	 * @param $userId (optional) : the user ID
	 * @return Dictionary object
	 */
	public function getById($id, $userId = null)
	{
		$currentUser = service('auth')->getCurrentUser();

		//Superuser, so set the access_level to admin value and attach to dictionary
		if ($userId === null && $currentUser->is_superuser) {
			$dictionary = $this->select('dictionary.*')
				->where(['id' => $id])
				->first();
			$dictionary->access_level = $dictionary->accessLevels['admin'];
			return $dictionary;
		}

		//if no userId is passed then use the current user's ID
		$userId = $userId ?? service('auth')->getCurrentUser()->id;

		//Standard user, so get the dictionary along with user's access level
		return $this->select('dictionary.*, access_level')
			->join('dictionary_user', 'dictionary_id = dictionary.id')
			->where(['id' => $id, 'user_id' => $userId])
			->first();
	}

	/**
	 * Retrieve the Dictionary array for a given user ID
	 * @param int $userId
	 * @return Dictionary array
	 */
	public function findForUser(int $userId)
	{
		return $this->select('dictionary.*, access_level')
			->join('dictionary_user', 'dictionary_id = dictionary.id')
			->where('user_id', $userId)
			->findAll();
	}
}