<?php

namespace App\Filters;

use App\Entities\Dictionary;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DictionaryFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{

	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		$user = service('auth')->getCurrentUser();
		if ($user->is_superuser) {
			return;
		}

		if (current_dictionary() === null || ! current_dictionary()->hasRequiredAccessLevel('user')) {

			$response = service('response');

			$response->setStatusCode(403);  //Access forbidden
			$response->setBody('<h1>Not authorised for this area<h1>');

			return $response;
		}
	}
}