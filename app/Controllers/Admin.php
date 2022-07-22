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
    
    $username = ('newuserone');
    $token = $this->request->getVar('token');
    
    $coba = $adminModel->where(array('user_name' => $username))->first();

    $adminModel->update($coba['user_pk'], array('user_token' => $token));

    
    //$res['message'] = $session;
    return json_encode($coba);

  }

}