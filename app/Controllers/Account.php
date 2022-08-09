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
        $rules = $this->userModel->validationRules;
		$data  = $this->request->getPost();
		
		if (!$this->validate($rules)) // ZEGY OTC tanpa perlu pembanding? auto dengan controller sekarang?
		{
			$datatofix =
            [
                'errors'     => $this->validator->getErrors(),
                'prev_input' => $data,
            ];
			return view('account/signup', $datatofix);
		}
		else
		{
            $arquivo  = ($this->request->getFile('arquivo'));
            $currentTime = new Time('now', 'America/Recife', 'pt_BR'); // ZEGY OTC Change to indonesia
            $arquivo->move(ROOTPATH . 'public/images', (string)$data['username'] . '.' . $arquivo->getClientExtension());
			$filePath = 'images/' . (string)$data['username'] . '.' . $arquivo->getClientExtension();

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
			// return view('account/sucessful_created');
		}
	}
}