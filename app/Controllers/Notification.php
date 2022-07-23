<?php namespace App\Controllers;

use App\Models\NotificationModel;

class Notification extends BaseController
{ 
    public function onFCM()
    {
    $notificationModel = new NotificationModel();
    
    $session = session('id');
    $token = $this->request->getVar('token');
    
    $data = $notificationModel->where(array('user_pk' => $session))->first();

    $notificationModel->update($data['user_pk'], array('user_token' => $token));
    }
}