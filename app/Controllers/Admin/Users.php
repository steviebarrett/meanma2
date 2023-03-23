<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Dictionary;
use App\Entities\User;
use App\Models\DictionaryModel;
use App\Models\UserModel;

class Users extends BaseController
{
	private $model;

	public function __construct()
	{
		$this->model = new \App\Models\UserModel;
	}

	/**
	 * Default page that lists the users for the current dictionary and paginates the list
	 *
	 * @return view Admin/Users/index
	 */
	public function index()
	{
		$dictId = dictionary_id();

		$users = $this->model->findByDictionaryId($dictId)
			->orderBy('id')
			->paginate(5, 'users');

		return view('Admin/Users/index', [
			'users' => $users,
			'pager' => $this->model->pager
		]);
	}

	public function show($id)
	{
		return view('Admin/Users/show', [
			'user' => $this->getUserOr404($id),
			'dictionary' => current_dictionary($id) //TODO: revisit this
		]);
	}

	public function new()
	{
		$user = new User;

		return view('/Admin/Users/new', [
			'user' => $user
		]);
	}

	public function create()
	{
		$post = $this->request->getPost();

		//fetch the access level for mapping the user to the dictionary
		$accessLevel = $post['access_level'];

		//remove the access_level from the post data so the user can be created
		unset($post['access_level']);
		$user = new User($post);

		//if password is empty, create a random password for security
		if ($user->password === null) {
			$user->password = bin2hex(random_bytes(16));
			$user->password_confirm = $user->password;
		}

		//check if user already exists in the DB
		if ($existingUser = $this->model->findByEmail($user->email)) {      //user already exist
			//insert the dictionary_user data in the DB
			$this->model->insertDictionaryUserRow(
				dictionary_id(), $accessLevel, $existingUser->id);
			//send the invitiation email
			$this->sendInvitationEmail($existingUser);
			return redirect()->to("/admin/users/show/{$existingUser->id}")
				->with('info', 'User added successfully');

		} elseif ($this->model->protect(false)->insert($user)) {    //new user to be created

			$userId = $this->model->insertID;

			//insert the dictionary_user data in the DB
			$this->model->insertDictionaryUserRow(
				dictionary_id(), $accessLevel);

			//set up password reset and send the email
			$newUser = $this->model->findById($userId);
			$newUser->startPasswordReset();
			$this->model->save($newUser);
			$this->sendInvitationEmail($newUser);

			return redirect()->to("/admin/users/show/{$userId}")
				->with('info', 'User created successfully');

		} else {                                                        //validation errors found

			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Invalid data')
				->withInput();
		}
	}

	private function sendInvitationEmail(User $user)
	{
		$dictionaryModel = new DictionaryModel();
		$dictionary = $dictionaryModel->getById(dictionary_id());

		$email = service('email');

		$email->setTo($user->email);
		$email->setSubject('Meanma Invitation');
		$message = view('Admin/Users/invite_email', [
			'user' => $user,
			'dictionary' => $dictionary,
			'token' => $user->reset_token
		]);

		$email->setMessage($message);

		$email->send();
	}

	public function edit($id)
	{
		$user = $this->getUserOr404($id);

		return view('Admin/Users/edit', [
			'user' => $user
		]);
	}


	public function update($id)
	{
		$user = $this->getUserOr404($id);

		$post = $this->request->getPost();

		//fetch the access level for mapping the user to the dictionary
		$accessLevel = $post['access_level'];
		$previousAccessLevel = current_dictionary($id)->access_level;

		//remove the access_level from the post data so the user can be created
		unset($post['access_level']);

		if (empty($post['password'])) {

			$this->model->disablePasswordValidation();

			unset($post['password']);
			unset($post['password_confirm']);
		}

		//update the accessLevel
		$this->model->updateDictionaryUserAccessLevel($id, dictionary_id(), $accessLevel);

		$user->fill($post);

		if (! $user->hasChanged()) {
			if ($accessLevel === $previousAccessLevel) {
				return redirect()->back()
					->with('warning', 'Nothing has changed')
					->withInput();
			} else {
				return redirect()->to("/admin/users/show/{$id}")
					->with('info', 'User access level updated successfully');
			}
		}

		if ($this->model->protect(false)->save($user)) {
			return redirect()->to("/admin/users/show/{$id}")
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
	 * @return UserModel $user
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