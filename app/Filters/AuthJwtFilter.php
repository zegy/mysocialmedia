<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Exception;

class AuthJwtFilter implements FilterInterface
{
	//Filter for every api request to require a previous token to allow the use of the api
    //token obtained on login from AuthJwt controller
  	use ResponseTrait;

	public function before(RequestInterface $request, $arguments = NULL)
	{
	    $key        = Services::getSecretKey();
	    $authHeader = $request->getServer('HTTP_AUTHORIZATION');
            
            if (is_null($authHeader)) { //JWT is absent
                
                return Services::response()->setJSON( [ 'error' => 'no token provided or invalid token'])
                                           ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
                 
            }
            
            $arr   = explode(' ', $authHeader);
	        $token = $arr[1];
            
            try {
		       JWT::decode($token, $key, ['HS256']); // Check token validity
                    //TO-DO: check expiration date here and invalidate if expired
		} catch (\Exception $e) {
                    
		    return Services::response()->setJSON(['error' => 'no token provided or invalid token'])
                                               ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
                }
	
                
        }

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
	{
		// Do something here
	}
    
}
