<?php

namespace App\Entities;

class Dictionary extends \CodeIgniter\Entity\Entity
{
	/*
	 * This array maps the possible system roles to the INT stored in the access_level
	 * field of the DB user record
	 *
	 * These values are used to check whether a user can access a given resource (e.g. the admin area)
	 */
	public $accessLevels = [
		'user'      => 10,
		'editor'    => 50,
		'admin'     => 70
	];

	/**
	 * A convenience method to quickly retrieve the name of an access level for a given
	 * integer as stored in the DB
	 *
	 * if the $level paramater is not used then the level name for current user and
	 * dictionary is returned
	 *
	 * @param int $level : the access_level as stored in the database
	 * @return string : the key of the $accessLevels array for the value $level
	 */
	public function getAccessLevelName(int $level = null)
	{
		if ($level === null) {
			return array_search($this->access_level, $this->accessLevels);
		} else {
			return array_search($level, $this->accessLevels);
		}
	}

	/**
	 * Checks if an access level is high enough for a given level name (e.g. 'admin')
	 * This is used to check whether a user can access certain features or areas for
	 * this dictionary
	 *
	 * @param string $levelName : the key of the $accessLevels array
	 * @return bool
	 */
	public function hasRequiredAccessLevel($levelName)
	{
		return $this->access_level >= $this->accessLevels[$levelName];
	}

}