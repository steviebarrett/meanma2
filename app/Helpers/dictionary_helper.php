<?php

if (! function_exists('dictionary_id')) {

	/**
	 * Gets current dictionary ID from the session
	 *
	 * @return int
	 */
	function dictionary_id()
	{
		$session = session();
		return $session->get('dictionary_id');
	}
}

if (! function_exists('dictionary_set_id')) {

	/**
	 * Sets the dictionary ID in the current session
	 *
	 * @param int $id : the dictionary ID
	 */
	function dictionary_set_id($id)
	{
		$session = session();
		$session->regenerate(); //prevent session attacks
		$session->set('dictionary_id', esc($id));
	}
}

if (! function_exists('current_dictionary')) {

	/**
	 * Gets the dictionary object for the currently stored dictionary_id session variable
	 *
	 * If a $userId is passed, then that user's access_level for this dictionary will be
	 * returned with the dictionary
	 *
	 * @param int $userId (optional)
	 * @return \App\Entities\Dictionary
	 */
	function current_dictionary($userId = null)
	{
		if (dictionary_id() === null) {
			return null;
		}
		$dictionary = model('DictionaryModel');
		return $dictionary->getById(dictionary_id(), $userId);
	}
}