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

    public function checkOwnership(int $cid, int $uid) // verify comment owner
    {
        $vcomment = $this->where('comment_pk', $cid)->first();

        if($vcomment)
        {
            return ($vcomment['comment_fk_user'] == $uid);
        }
        else
        {
            return false;
        }
    }

    public function getAllByKeyword(string $keyword) : array // returns all comments based on a searched keyword
    {
        $builder = $this->db->table('t_comment c');

        $builder->select('
                            c.comment_pk            as cid,
                            c.comment_text          as texto,
                            c.comment_date_time     as data,
                            u.user_pk               as uid,
                            u.user_full_name        as nome,
                            u.user_profile_picture  as image,
                            p.post_pk               as pid,
                        ');
        $builder->join('t_post p', 'p.post_pk = c.comment_fk_post');
        $builder->join('t_user u', 'c.comment_fk_user = u.user_pk');
        $builder->like('c.comment_text', $keyword);
        $res = $builder->get()->getResult();
        return $res;
    }

    public function getAllByPost($pid)
    {
        $builder = $this->db->table('t_comment c');
        $builder->select('
                            c.comment_pk            as cid,
                            c.comment_text          as texto,
                            c.comment_date_time     as data,
                            u.user_pk               as uid,
                            u.user_full_name        as nome,
                            u.user_profile_picture  as image,
                        ');
        $builder->join('t_post p', 'p.post_pk = c.comment_fk_post');
        $builder->join('t_user u', 'c.comment_fk_user = u.user_pk');
        $builder->where('p.post_pk = $pid');
        $queryComments = $builder->get()->getResult();
        return $queryComments;
    }
}