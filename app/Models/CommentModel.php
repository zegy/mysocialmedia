<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table         = 't_comment';
    protected $primaryKey    = 'comment_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'comment_fk_user',
        'comment_fk_post',
        'comment_text'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'comment_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps

    //NOTE (Pending): It has mixed format
    protected $select = '
        comment_pk           as cid,
        comment_text         as texto,
        comment_date_time    as data,
        user_pk              as uid,
        user_full_name       as nome,
        user_profile_picture as image,
        (SELECT COUNT(*) FROM t_like WHERE like_fk_comment = comment_pk AND like_status = 0) AS nolike,
        (SELECT COUNT(*) FROM t_like WHERE like_fk_comment = comment_pk AND like_status = 1) AS nodislike,
    ';

    public function getAllByPost($pid)
    {
        return $this->select($this->select . '(SELECT like_status FROM t_like WHERE like_fk_user = ' . session('id') . ' AND like_fk_comment = comment_pk) AS like_status')
                    ->join('t_post', 'post_pk = comment_fk_post')
                    ->join('t_user', 'comment_fk_user = user_pk') //TODO : Werid syntax here (or others)
                    ->where('post_pk', $pid)
                    ->findAll();
    }

    public function getCountComment($pid)
    {
        return $this->where('comment_fk_post', $pid)
                    ->countAllResults();
    }    
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/