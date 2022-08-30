<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table         = 't_comment';
    protected $primaryKey    = 'comment_pk';
    protected $allowedFields =
    [
        'comment_fk_user',
        'comment_fk_post',
        'comment_text',
        'comment_date_time'
    ];

    public function getAllByKeyword($keyword)
    {
        $builder = $this->db->table('t_comment')
            ->select('
                        comment_pk           as cid,
                        comment_text         as texto,
                        comment_date_time    as data,
                        user_pk              as uid,
                        user_full_name       as nome,
                        user_profile_picture as image,
                        post_pk              as pid
                    ')
            ->join('t_post', 'post_pk = comment_fk_post')
            ->join('t_user', 'comment_fk_user = user_pk')
            ->like('comment_text', $keyword);
        return $builder->get()->getResult();
    }

    public function countComment($pid)
    {
        $builder = $this->db->table('t_comment')
            ->where(["comment_fk_post" => $pid]);
        return $builder->countAllResults();
    }

    public function getAllByPost($pid)
    {
        $builder = $this->db->table('t_comment')
            ->select('
                        comment_pk           as cid,
                        comment_text         as texto,
                        comment_date_time    as data,
                        user_pk              as uid,
                        user_full_name       as nome,
                        user_profile_picture as image
                    ')
            ->join('t_post', 'post_pk = comment_fk_post')
            ->join('t_user', 'comment_fk_user = user_pk')
            ->where('post_pk', $pid);
        return $builder->get()->getResult();
    }
}