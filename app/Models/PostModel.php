<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table         = 't_post';
    protected $primaryKey    = 'post_pk';
    protected $returnType    = 'object'; // ZEGY OTC : global return here, no individual one?
    protected $allowedFields =
    [
        'post_fk_user',
        'post_text',
        'post_type'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'post_date_time';
    protected $updatedField  = ''; // [Zegy OTC] It's needed by "useTimestamps" even if we not use it.

    // [Zegy Note]
    // The Model does not provide a perfect interface to the Query Builder.
    // The Model and the Query Builder are separate classes with different purposes.
    // Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    // Query Builder methods and Model’s CRUD methods can be in the same chained call.
    // https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder

    public function getOneById($pid)
    {
        return $this->select('
                                post_pk              as pid,
                                post_text            as texto,
                                post_date_time       as data,
                                post_type            as type,
                                user_pk              as uid,
                                user_full_name       as nome,
                                user_profile_picture as image,
                                user_role            as role
                            ')
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->find($pid);
    }

    public function getAllByType($postType)
    {
        return $this->select('
                                post_pk              as pid,
                                post_text            as texto,
                                post_date_time       as data,
                                post_type            as type,
                                user_pk              as uid,
                                user_full_name       as nome,
                                user_profile_picture as image,
                                user_role            as role,
                                (select count(*) from t_comment
                                    where comment_fk_post = post_pk) as qtdcom
                            ')
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_type', $postType)
                    ->orderBy('post_pk', 'DESC');
    }

    public function getAllByUser($uid)
    {
        return $this->select('
                                post_pk              as pid,
                                post_text            as texto,
                                post_date_time       as data,
                                post_type            as type,
                                user_pk              as uid,
                                user_full_name       as nome,
                                user_profile_picture as image,
                                user_role            as role,
                                (select count(*) from t_comment
                                    where comment_fk_post = post_pk) as qtdcom
                            ')
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->where('post_fk_user', $uid)
                    ->orderBy('post_pk', 'DESC');
    }

    public function getAllByKeyword($keyword)
    {   
        return $this->select('
                                post_pk              as pid,
                                post_text            as texto,
                                post_date_time       as data,
                                post_type            as type,
                                user_pk              as uid,
                                user_full_name       as nome,
                                user_profile_picture as image,
                                user_role            as role,
                                (select count(*) from t_comment
                                    where comment_fk_post = post_pk) as qtdcom
                            ')
                    ->join('t_user', 'post_fk_user = user_pk')
                    ->like('post_text', $keyword)
                    ->findAll(); // ZEGY OTC : is this the right method?
    }

    // public function selectedData()
    // {
    //     return $this->select('
    //                             post_pk              as pid,
    //                             post_text            as texto,
    //                             post_date_time       as data,
    //                             post_type            as type,
    //                             user_pk              as uid,
    //                             user_full_name       as nome,
    //                             user_profile_picture as image,
    //                             user_role            as role
    //                         ');
    // }
}