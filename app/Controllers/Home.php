<?php

namespace App\Controllers;

class Home extends BaseController
{
	/**
	 * Calls a simple view for testing routing and authentication only
	 *
	 * @return test view
	 */
	public function test($view = 'none')
	{
		return view('test', [
			'view' => $view
		]);
	}
}
