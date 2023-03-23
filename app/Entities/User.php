<?php

namespace App\Entities;

use \App\Libraries\Token;
use App\Models\DictionaryModel;

class User extends \CodeIgniter\Entity\Entity
{
	public $reset_token;

	public function verifyPassword($password)
	{
		return password_verify($password, $this->password_hash);
	}

	public function startActivation()
	{
		$token = new Token;
		$this->token = $token->getValue();
		$this->activation_hash = $token->getHash();
	}

	public function activate()
	{
		$this->is_active = true;
		$this->activation_hash = null;
	}

	public function startPasswordReset()
	{
		$token = new Token;
		$this->reset_token = $token->getValue();
		$this->reset_hash = $token->getHash();
		$this->reset_expires_at = date('Y-m-d H:i:s', time() + 7200);
	}

	public function completePasswordReset()
	{
		$this->reset_hash = null;
		$this->reset_expires_at = null;
	}

	/**
	 * Retrieves the Dictionary objects for this user
	 *
	 * If there is no user ID an empty array is returned
	 *
	 * @return array Dictionary
	 */
	public function getDictionaries()
	{
		if ($this->id === null) {
			return [];
		}
		return model(DictionaryModel::class)->findForUser($this->id);
	}

	/**
	 * Returns each Dictionary ID for which this user has access
	 *
	 * @return array int $dictionaryIds
	 */
	public function getDictionaryIds()
	{
		$dictionaryIds = [];
		foreach ($this->getDictionaries() as $dictionary) {
			$dictionaryIds[] = $dictionary->id;
		}
		return $dictionaryIds;
	}

}