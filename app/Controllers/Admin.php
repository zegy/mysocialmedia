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
    
    $session = session('id');
    $token = $this->request->getVar('token');
    
    $data = $adminModel->where(array('user_pk' => $session))->first();

    $adminModel->update($data['user_pk'], array('user_token' => $token));

    
    //$res['message'] = $session;
    //return json_encode($coba);

  }

}