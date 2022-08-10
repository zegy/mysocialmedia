<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class Account extends BaseController
{
	function __construct()
	{
		helper('form');
		$this->userModel = new UserModel();
	}

	public function signUp()
	{
		return view('account/signup');
	}

	public function createAccount()
	{
        $data  = $this->request->getPost();
        $rules = $this->userModel->val_rules;
        
        $email_exist    = $this->userModel->isEmailExist($data['email']); // Check if email exist
        $username_exist = $this->userModel->isUsernameExist($data['username']); // Check if username exist
        
        $e_email    = null;
        $e_username = null;
        $e_rules    = null;

		if ($email_exist == true)
        {
            $e_email = ("email sudah digunakan!");
        }
        
        if ($username_exist == true)
        {
            $e_username = ("username sudah digunakan!");
        }

        if (!$this->validate($rules)) // validate first, then send to model (using basic CRUD)
        {                             // ZEGY OTC tanpa perlu pembanding? auto dengan controller sekarang?
            $e_rules = $this->validator->getErrors();
        }

        if (isset($e_email) || isset($e_username) || isset($e_rules))
        {
            return view('account/signup',
            [
                'prev_input'    => $data,
                'error_email'   => $e_email,
                'error_username'=> $e_username,
                'errors'        => $e_rules
            ]);
        }
        else
        {
            $profile_img  = ($this->request->getFile('profile_img'));
            $currentTime = new Time('now', 'America/Recife', 'pt_BR'); // ZEGY OTC Change to indonesia
            $profile_img->move(ROOTPATH . 'public/images', (string)$data['username'] . '.' . $profile_img->getClientExtension());
            $filePath = 'images/' . (string)$data['username'] . '.' . $profile_img->getClientExtension();

            switch ((string)($data['jenis_kelamin']))
            {
                case 'm':
                    $gender = 'm'; break;
                case 'f':
                    $gender = 'f'; break;
            }

            $dataToSave =
            [
                'user_full_name'   	   => $data['nama_lengkap'], 
                'user_name'  		   => (string)$data['username'],
                'user_email'  		   => $data['email'],
                'user_tel'    		   => $data['nomor_handphone'],
                'user_password'  	   => password_hash((string)$data['password'], PASSWORD_DEFAULT),
                'user_profile_picture' => (string)$filePath,
                'user_bio'    		   => $data['bio'],
                'user_sex'			   => $gender,
                'user_regis_date_time' => ((array)$currentTime)['date']
            ];

            $result = $this->userModel->save($dataToSave); // method "save" dari "BaseModel"
            return view('account/sucessful_created');
        }
    }
}