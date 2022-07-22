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

    $data = $adminModel->where(array('user_name' => $username))->first();
    
    $adminModel->update($data['user_pk'], array('user_token' => $token));
    $res['message'] = 'Success';
    
    return json_encode($res);

  }

}