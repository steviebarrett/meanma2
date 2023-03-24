<?php

namespace App\Controllers\SuperUser;

use App\Controllers\BaseController;
use App\Models\DictionaryModel;
use App\Entities\Dictionary;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Class that provides methods to allow superusers to administer all dictionaries
 * and add new ones
 */
class Dictionaries extends BaseController
{
	private $model;

	public function __construct()
	{
		$this->model = new DictionaryModel;
	}

	/**
	 * Show dictionary info
	 *
	 * @param int $id : dictionary ID
	 * @return View
	 */
	public function show($id)
	{
		return view('SuperUser/Dictionaries/show', [
			'dictionary' => $this->getDictionaryOr404($id),
		]);
	}

	/**
	 * Show new dictionary form
	 *
	 * @return View
	 */
	public function new()
	{
		$dictionary = new Dictionary;

		return view('/SuperUser/Dictionaries/new', [
			'dictionary' => $dictionary
		]);
	}

	/**
	 * Create a new dictionary in the DB
	 *
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 * @throws \ReflectionException
	 */
	public function create()
	{
		$post = $this->request->getPost();

		$dictionary = new Dictionary($post);

		//insert the dictionary in the DB
		if ($this->model->protect(false)->insert($dictionary)) {

			return redirect()->to("/superuser/dictionaries/show/{$this->model->insertID}")
				->with('info', 'Dictionary created successfully');

		} else {

			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Invalid data')
				->withInput();
		}
	}

	/**
	 * Show the dictionary edit form
	 *
	 * @param int $id : dictionary ID
	 * @return View
	 */
	public function edit($id)
	{
		$dictionary = $this->getDictionaryOr404($id);

		return view('SuperUser/Dictionaries/edit', [
			'dictionary' => $dictionary
		]);
	}

	/**
	 * Update the dictionary info
	 *
	 * @param int $id : dictionary ID
	 * @return \CodeIgniter\HTTP\RedirectResponse
	 * @throws \ReflectionException
	 */
	public function update($id)
	{
		$dictionary = $this->getDictionaryOr404($id);

		$post = $this->request->getPost();

		$dictionary->fill($post);

		if (! $dictionary->hasChanged()) {
			return redirect()->back()
				->with('warning', 'Nothing has changed')
				->withInput();
		}

		if ($this->model->protect(false)->save($dictionary)) {
			return redirect()->to("/superuser/dictionaries/show/{$id}")
				->with('info', 'Dictionary updated successfully');
		} else {
			return redirect()->back()
				->with('errors', $this->model->errors())
				->with('warning', 'Invalid data')
				->withInput();
		}
	}

	/**
	 * Runs a check to see if a dictionary with id = $id exists.
	 * If it does then the Dictionary object is returned
	 * Otherwise a PageNotFoundException is thrown to alert the user
	 *
	 * @param $id
	 * @return Dictionary $dictionary
	 * @throws PageNotFoundException
	 */
	private function getDictionaryOr404($id)
	{
		$dictionary = $this->model->where('id', $id)
			->first();

		if ($dictionary === null) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException("Dictionary with id {$id} not found");
		}

		return $dictionary;
	}
}