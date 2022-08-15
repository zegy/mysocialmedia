<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 't_user';
    protected $primaryKey    = 'user_pk';
    protected $allowedFields =
    [
        'user_name',
        'user_password',
        'user_full_name',
        'user_email',
        'user_tel',
        'user_profile_picture',
        'user_regis_date_time',
        'user_sex',
        'user_bio',
        'user_token',
        'user_role'
    ];
    
    protected $val_rules = // don't name it "validationRules". broke CI's proper basic CRUD->check valid->error return
	[
        'nama_lengkap'        => 'required|min_length[3]',
        'username'            => 'required|min_length[5]',
        'email'               => 'required|valid_email',
        'nomor_handphone'     => 'required|min_length[8]|numeric',
        'password'            => 'required|min_length[8]',
        'konfirmasi_password' => 'required|matches[password]',
        'userfile' => // ZEGY OTC WHAT USERFILE?
        [
            'label' => 'foto profil',
            'rules' => 'uploaded[profile_img]'
                    . '|is_image[profile_img]'
                    . '|mime_in[profile_img,image/jpg,image/jpeg]'
                    . '|max_size[profile_img,30]'
                    . '|max_dims[profile_img,200,200]',
        ],
        'bio'                 => 'required|max_length[250]',
        'jenis_kelamin'       => 'required'
    ];

    public function getByEmail(string $email): array
    {
        $rq = $this->where('user_email', $email)->first();
        return !is_null($rq) ? $rq : [];
    }

    public function getById(int $uid): array
    {
        $rq = $this->where('user_pk', $uid)->first();
        return !is_null($rq) ? $rq : [];
    }

    public function getAllByKeyword(string $keyword) : array
    {
        $builder = $this->builder('t_user');
        $res = $builder->select('
                                    user_pk               as uid,
                                    user_full_name        as nome,
                                    user_email            as email, 
                                    user_tel              as tel,
                                    user_profile_picture  as img, 
                                    user_regis_date_time  as cad,
                                    user_sex              as sexo,
                                    user_bio              as bio
                                ')
                            ->like('user_full_name', $keyword)
                            ->get()
                            ->getResult();
        return $res;
    }

    public function isEmailExist($email) // check if email exist
    {
        $existEmail = $this->where('user_email', $email)->first();
                         
        if($existEmail)
        {
            return true;
        }
        else
        {    
            return false;
        }
    }

    public function isUsernameExist($username) // check if email exist
    {
        $existUsername = $this->where('user_name', $username)->first();
                         
        if($existUsername)
        {
            return true;
        }
        else
        {    
            return false;
        }
    }

    public function isDosenByUsername($username)
    {
        $user = $this->where('user_name', $username)->first();
        
        if($user['user_role'] == 'dosen')
        {                 
            return true;
        }
        else
        {    
            return false;
        }
    }    
}