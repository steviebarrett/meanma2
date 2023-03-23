<?php

namespace App\Controllers\SuperUser;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Models\DictionaryModel;
use App\Models\UserModel;

class Users extends BaseController
{
	private $model;
	private $dictionaryModel;

	public function __construct()
	{
		$this->model = new UserModel;
		$this->dictionaryModel = new DictionaryModel();
	}

	public function show($id)
	{
		return view('SuperUser/Users/show', [
			'user' => $this->getUserOr404($id),
			'dictionaries' => $this->getUserOr404($id)->getDictionaries()
		]);
	}

	public function new()
	{
		$user = new User;

		return view('/SuperUser/Users/new', [
			'user' => $user,
			'dictionaries' => $this->dictionaryModel->orderBy('name')->paginate()
		]);
	}

	public function create()
	{
		$post = $this->request->getPost();

		//fetch the access level for mapping the user to the dictionary
		if ($dictionaryId  = $post['dictionary_id']) {
			$accessLevel = $post['access_level'];
		}

		//remove the dictionary_id and access_level from the post data so the user can be created
		unset($post['dictionary_id']);
		unset($post['access_level']);
		$user = new User($post);

		//insert the user in the DB
		if ($this->model->protect(false)->insert($user)) {

			//insert the dictionary_user data in the DB
			$this->model->insertDictionaryUserRow(
				$dictionaryId, $accessLevel);

			return redirect()->to("/superuser/users/show/{$this->model->insertID}")
				->with('info', 'User created successfully');

		} else {

			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Invalid data')
				->withInput();
		}
	}

	public function edit($id)
	{
		$user = $this->getUserOr404($id);

		return view('SuperUser/Users/edit', [
			'user' => $user,
			'dictionaries' => $this->dictionaryModel->orderBy('name')->paginate()
		]);
	}


	public function update($id)
	{
		$user = $this->getUserOr404($id);

		$post = $this->request->getPost();

		//fetch the new dictionary data to be added for this user
		if ($dictionaryId  = $post['dictionary_id']) {
			$accessLevel = $post['access_level'];
			//insert the dictionary_user data in the DB
			$this->model->insertDictionaryUserRow($dictionaryId, $accessLevel, $id);
		}

		//remove the dictionary_id and access_level from the post data so the user can be created
		unset($post['dictionary_id']);
		unset($post['access_level']);

		if (empty($post['password'])) {
			$this->model->disablePasswordValidation();
			unset($post['password']);
			unset($post['password_confirm']);
		}

		$user->fill($post);

		if (! $user->hasChanged()) {
			if (! $dictionaryId) {
				return redirect()->back()
					->with('warning', 'Nothing has changed')
					->withInput();
			} else {
				return redirect()->to("/superuser/users/show/{$id}")
					->with('info', 'User added to dictionary');
			}
		}

		if ($this->model->protect(false)->save($user)) {
			return redirect()->to("/superuser/users/show/{$id}")
				->with('info', 'User updated successfully');
		} else {
			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Invalid data')
				->withInput();
		}
	}

	/**
	 * Runs a check to see if a user with id = $id exists.
	 * If it does then the UserModel object is returned
	 * Otherwise a PageNotFoundException is thrown to alert the user
	 *
	 * @param $id
	 * @return User $user
	 */
	private function getUserOr404($id)
	{
		$user = $this->model->where('id', $id)
			->first();

		if ($user === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id {$id} not found");
		}

		return $user;
	}
}