<?php

namespace App\Libraries;

class Authentication
{
	private $user;

	public function login($email, $password)
	{
		$model = new \App\Models\UserModel;

		$user = $model->findByEmail($email);

		if ($user === null) {
			return false;
		}

		if (! $user->verifyPassword($password)) {
			return false;
		}

		if (! $user->is_active) {
			return false;
		}

		$this->loginUser($user);

		return true;
	}

	private function loginUser($user)
	{
		$session = session();
		$session->regenerate(); //prevent session attacks
		$session->set('user_id', $user->id);
	}

	public function logout()
	{
		session()->destroy();
	}

	private function getUserFromSession()
	{
		if (! session()->has('user_id')) {
			return null;
		}

		$model = new \App\Models\UserModel;

		$user = $model->find(session()->get('user_id'));

		if ($user && $user->is_active) {

			return $user;
		}
	}

	public function getCurrentUser()
	{
		if ($this->user === null) {

			$this->user = $this->getUserFromSession();
		}

		return $this->user;
	}

	public function isLoggedIn() {
		return $this->getCurrentUser() !== null;
	}
}