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
            return redirect()->to('auth');
		}
	}


	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
