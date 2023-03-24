<?php

namespace App\Libraries;

/**
 * A class to generate and retrieve a random token for use when resetting a password
 * in order to maintain security
 *
 * The getHash() method utilises the environment HASH_SECRET_KEY constant for increased security
 *
 */
class Token
{
	private $token;

	public function __construct($token = null)
	{
		if ($token === null) {
			$this->token = bin2hex(random_bytes(16));
		} else {
			$this->token = $token;
		}
	}

	public function getValue()
	{
		return $this->token;
	}

	public function getHash()
	{
		return hash_hmac('sha256', $this->token, $_ENV['HASH_SECRET_KEY']);
	}
}