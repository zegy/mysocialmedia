<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{

	public function before(RequestInterface $request, $arguments = null)
	{
		if (session('isLoggedIn') != true) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
		}
	}


	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
