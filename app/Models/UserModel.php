<?php

namespace App\Models;

use \App\Libraries\Token;

/**
 * Class that provides the CRUD methods required to work with the `user` DB table
 */
class UserModel extends \CodeIgniter\Model
{
	protected $table = 'user';

	protected $allowedFields = ['firstname', 'lastname', 'email', 'password',
		'reset_hash', 'is_superuser', 'reset_expires_at', 'last_logged_in_at'];

	protected $returnType = 'App\Entities\User';

	protected $useTimestamps = true;

	protected $validationRules = [
		'firstname' => 'required',
		'lastname' => 'required',
		'email' => 'required|valid_email|is_unique[user.email]',
		'password' => 'required|min_length[6]',
		'password_confirm' => 'required|matches[password]'
	];

	protected $validationMessages = [
		'email' => [
			'is_unique' => 'That email is taken'
		],
		'password_confirm' => [
			'required' => 'Confirm password is required' ,
			'matches' => 'Passwords don\'t match'
		]];

	//model events that calls hashPassword
	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];

	/**
	 * Securely hashes the password for storage in the DB
	 *
	 * @param array $data
	 * @return array
	 */
	protected function hashPassword(array $data)
	{
		if (isset($data['data']['password'])) {
			$data['data']['password_hash'] = password_hash($data['data']['password'],
				PASSWORD_DEFAULT);

			unset($data['data']['password']);
			unset($data['data']['password_confirm']);
		}
		return $data;
	}

	/**
	 * @param int $id
	 * @return User
	 */
	public function findById(int $id) {
		return $this->where('id', $id)->first();
	}

	/**
	 * @param string $email
	 * @return User
	 */
	public function findByEmail(string $email)
	{
		return $this->where('email', $email)
			->first();
	}

	/**
	 * Returns an array of User objects with access to a dictionary identified by the
	 * dictionary ID
	 *
	 * @param int $id : the dictionary ID
	 * @return array User
	 */
	public function findByDictionaryId(int $id)
	{
		return $this->join('dictionary_user', 'user_id = id')
			->where('dictionary_id', $id);
	}

	public function disablePasswordValidation()
	{
		unset($this->validationRules['password']);
		unset($this->validationRules['password_confirm']);
	}

	/**
	 * Fetches the User object for a given token
	 *
	 * Used for password reset
	 *
	 * @param Token $token
	 * @return User
	 */
	public function getUserForPasswordReset($token)
	{
		$token = new Token($token);
		$token_hash = $token->getHash();
		$user = $this->where('reset_hash', $token_hash)
			->first();

		if ($user) {
			if ($user->reset_expires_at < date('Y-m-d H:i:s')) {    //expired
				$user = null;
			}
		}
		return $user;
	}

	/**
	 * Updates the last_logged_in_at property of the current user and updates the DB
	 *
	 * @param string $email : the email address of the logged-in user
	 * @throws \ReflectionException
	 */
	public function updateLoggedInAt(string $email): void
	{
		$user = $this->findByEmail($email);
		$user->last_logged_in_at = date('Y-m-d H:i:s', time());
		$this->save($user);
	}

	/**
	 * Inserts a row into the `dictionary_user` DB table to map this user to a dictionary
	 *
	 * @param int $dictionaryId
	 * @param int $accessLevel
	 * @param int $userId (optional) : the userId will be passed if the user record has not
	 *                      been newly created and the insertId is therefore unavailable
	 */
	public function insertDictionaryUserRow(int $dictionaryId, int $accessLevel, int $userId = null): void
	{
		$userId =  $userId ?? $this->insertID;
		$dictionaryId = esc($dictionaryId);
		$accessLevel = esc($accessLevel);
		$sql = <<<SQL
			INSERT INTO `dictionary_user` VALUES({$userId}, {$dictionaryId}, {$accessLevel});
SQL;
		$this->db->query($sql);
	}


	/**
	 * Updates the access_level column in the `dictionary_user` table
	 *
	 * @param int $id : the user ID
	 * @param int $dictionaryId
	 * @param int $accessLevel
	 */
	public function updateDictionaryUserAccessLevel(int $userId, int $dictionaryId, int $accessLevel): void
	{
		$userId = esc($userId);
		$dictionaryId = esc($dictionaryId);
		$accessLevel = esc($accessLevel);
		$sql = <<<SQL
			UPDATE `dictionary_user` SET `access_level` = '{$accessLevel}' 
				WHERE `user_id` = '{$userId}' AND `dictionary_id` = '{$dictionaryId}';
SQL;
		$this->db->query($sql);
	}


}