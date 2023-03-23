<?php

namespace App\Controllers;

use App\Entities\User;

class Login extends BaseController
{
	public function new()
	{
		return view('Login/login');
	}

	public function create()
	{
		$email = $this->request->getPost('email');
		$password = $this->request->getPost('password');

		$auth = service('auth');

		if ($auth->login($email, $password)) {

			//update the user last_logged_in_at property
			$user = new \App\Models\UserModel();
			$user->updateLoggedInAt($email);

			$redirect_url = session('redirect_url') ?? '/';

			unset($_SESSION["redirect_url"]);

			return redirect()->to($redirect_url)
				->with('info', 'login successful')
				->withCookies();

		} else {
			return redirect()->back()
				->withInput()
				->with('warning', 'invalid login');
		}
	}

	public function delete()
	{
		$auth = service('auth');

		$auth->logout();

		return redirect()->to('login/showLogoutMessage')
			->withCookies();
	}

	public function showLogoutMessage()
	{
		return redirect()->to('/')
			->with('info', 'logged out');
	}


}