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
        'post_date_time',
        'post_type'
    ];

    public function getAllPost($postType)
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

    public function getSpecificPost($pid)
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
                    ->where('post_pk', $pid)
                    ->first(); // ZEGY OTC : is this the right method?
    }
}