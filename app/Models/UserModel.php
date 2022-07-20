<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 't_user';
    protected $primaryKey = 'user_pk';

    protected $allowedFields = [ 'user_name',
                                 'user_password',
                                 'user_full_name',
                                 'user_email',
                                 'user_tel',
                                 'user_profile_picture',
                                 'user_regis_date_time',
                                 'user_sex',
                                 'user_bio' ];

                                 
    protected $db;                       


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


    public function getByNome(string $nome): array
    {

        $rq = $this->where('user_email', $nome)->findAll();  //muda

        return !is_null($rq) ? $rq : [];
    }


    public function getPosts(int $uid): array //  retornar todos os posts desse usuario
    {

      // $user = $this->getById($uid);

        $builder = $this->builder('t_post p');

        $res =  $builder->select('p.*, u.user_full_name')
                        ->join('t_user u', 'u.user_pk = p.post_fk_user') // a tabela com a qual vai cruzar vem como argumento do join
                        ->where("p.post_fk_user", $uid)
                        ->get()
                        ->getResult();

        return $res; 

       
    }


    public function getAllByKeyword(string $keyword) : array
    {

        $builder = $this->builder('t_user');

        $res     =  $builder->select('user_pk as uid,user_full_name as nome, user_email as email, 
                                      user_tel as tel, user_profile_picture as img, 
                                      user_regis_date_time as cad, user_sex as sexo, user_bio as bio  ')
                            ->like('user_full_name', $keyword)
                            ->get()
                            ->getResult();

       
        return $res;
      
    }

    
}
