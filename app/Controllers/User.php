<?php

namespace App\Controllers;

use App\Models\DictionaryModel;
use App\Models\UserModel;

class User extends BaseController
{
	public function home()
	{
		//reset any stored dictionary ID
	//	dictionary_set_id(null);

		if (! session('user_id')) {
			redirect('login');
		}
		if (current_user()->is_superuser) {     //return the superuser homepage view

			//set a default dictionary id
			dictionary_set_id(1);       //TODO: replace the hardcoded value here

			$dictionaryModel = new DictionaryModel();
			$dictionaries = $dictionaryModel
				->orderBy('id')
				->paginate(5, 'dictionaries');
			$userModel = new UserModel();
			$users = $userModel
				->orderBy('id')
				->paginate(5, 'users');
			return view('User/superuser', [
				'users' => $users,
				'pager' => $userModel->pager,
				'dictionaries' => $dictionaries
			]);
		} else {
			return view('User/home');   //return the user homepage view
		}
	}

}