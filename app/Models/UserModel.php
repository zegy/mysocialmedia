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
        'user_bio'
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

    public function getByNome(string $nome): array // ZEGY OTC NEED TO VERIF IF EMAIL ALREADY USED!
    {
        $rq = $this->where('user_email', $nome)->findAll(); // change
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
}