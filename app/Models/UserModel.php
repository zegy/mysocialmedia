<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 't_user';
    protected $primaryKey    = 'user_pk';
    protected $returnType    = 'object'; // ZEGY OTC : global return here, no individual one?
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

    public function getAllByKeyword($keyword)
    {
        return $this->select('
                                user_pk              as uid,
                                user_full_name       as nome,
                                user_profile_picture as img,
                                user_bio             as bio
                            ')
                    ->like('user_full_name', $keyword)
                    ->findAll(); // ZEGY OTC : is this the right method?
    }
}