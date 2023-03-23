<?php

if (! function_exists('dictionary_id')) {

	function dictionary_id()
	{
		$session = session();
		return $session->get('dictionary_id');
	}
}

if (! function_exists('dictionary_set_id')) {

	function dictionary_set_id($id)
	{
		$session = session();
		$session->regenerate(); //prevent session attacks
		$session->set('dictionary_id', esc($id));
	}
}

if (! function_exists('current_dictionary')) {

	function current_dictionary($userId = null)
	{
		if (dictionary_id() === null) {
			return null;
		}
		if (function_exists('current_user') && current_user()->is_superuser) {
			$userId = -1;
		}
		$dictionary = model('DictionaryModel');
		return $dictionary->getById(dictionary_id(), $userId);
	}
}