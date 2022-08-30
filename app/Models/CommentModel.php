<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table         = 't_comment';
    protected $primaryKey    = 'comment_pk';
    protected $allowedFields = // security: defines which fields can be changed
    [
        'comment_fk_user',
        'comment_fk_post',
        'comment_text',
        'comment_date_time'
    ];

    public function getAllByKeyword(string $keyword) : array // returns all comments based on a searched keyword
    {
        $builder = $this->db->table('t_comment');

        $builder->select('
                            comment_pk            as cid,
                            comment_text          as texto,
                            comment_date_time     as data,
                            user_pk               as uid,
                            user_full_name        as nome,
                            user_profile_picture  as image,
                            post_pk               as pid,
                        ');
        $builder->join('t_post', 'post_pk = comment_fk_post');
        $builder->join('t_user', 'comment_fk_user = user_pk');
        $builder->like('comment_text', $keyword);
        $res = $builder->get()->getResult();
        return $res;
    }

    public function getAllByPost($pid)
    {
        $builder = $this->db->table('t_comment');
        $builder->select('
                            comment_pk            as cid,
                            comment_text          as texto,
                            comment_date_time     as data,
                            user_pk               as uid,
                            user_full_name        as nome,
                            user_profile_picture  as image,
                        ');
        $builder->join('t_post', 'post_pk = comment_fk_post');
        $builder->join('t_user', 'comment_fk_user = user_pk');
        $builder->where('post_pk', $pid);
        $queryComments = $builder->get()->getResult();
        return $queryComments;
    }
}