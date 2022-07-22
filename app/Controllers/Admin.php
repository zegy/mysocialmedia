<?php namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{ 
  public function login()
  {
    return view('admin/login');
  }

  
  public function doLogin()
  {
    $adminModel = new AdminModel();
    
    $email = ('admin@gmail.com');
    $token = $this->request->getVar('token');

    $data = $adminModel->where(array('email' => $email))->first();
    
    $adminModel->update($data['id'], array('token' => $token));
    $res['message'] = 'Success';
    
    return json_encode($res);

  }

}