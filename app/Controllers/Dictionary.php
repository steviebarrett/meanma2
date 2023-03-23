<?php

namespace App\Controllers;

use App\Models\DictionaryModel;

class Dictionary extends BaseController
{
	public function home($id)
	{
		dictionary_set_id($id);
		return view('Dictionary/home');
	}

}