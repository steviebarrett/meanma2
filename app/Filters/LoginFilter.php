<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{

		if (! service('auth')->isLoggedIn()) {

			//save the requested URL in the session
			session()->set('redirect_url', current_url());

			return redirect()->to('/login')
				->with('warning',  'please login');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{

	}
}