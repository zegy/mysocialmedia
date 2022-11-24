<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 't_user';
    protected $primaryKey    = 'user_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'user_name',
        'user_password',
        'user_full_name',
        'user_email',
        'user_tel',
        'user_profile_picture',
        'user_sex',
        'user_bio',
        'user_token',
        'user_role'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'user_regis_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps

    //NOTE Custom var with "standard query" string (instead of CI's Model and Query Builder)
    protected $selected = '
        user_pk,
        user_name,
        user_full_name,
        user_profile_picture,
        user_role
    ';

    public function getAll($page = null)
    {
        return $this->select($this->selected)
                    ->orderBy('user_pk', 'DESC')
                    ->paginate(5, 'default', $page);
    }

    public function getAllByKeyword($keyword)
    {
        return $this->select($this->selected)
                    ->like('user_full_name', $keyword)
                    ->get()
                    ->getResult();
    }
        
    // public function getAllByKeyword($keyword)
    // {
    //     return $this->select('
    //                             user_pk              as uid,
    //                             user_full_name       as nome,
    //                             user_profile_picture as img,
    //                             user_bio             as bio
    //                         ')
    //                 ->like('user_full_name', $keyword)
    //                 ->findAll();
    // }
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/