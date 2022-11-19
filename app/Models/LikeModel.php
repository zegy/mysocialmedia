<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table         = 't_like';
    protected $primaryKey    = 'like_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'like_fk_user',
        'like_fk_comment',
        'like_status'
    ];
    protected $useTimestamps = true; //TODO : Need this for "like"?. Sync with DB and other if no!
    protected $createdField  = 'like_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps

    // protected $select = '
    //     like_pk     as cid,
    //     user_pk     as uid,
    //     comment_pk  as uid,
    // ';

    // public function getAllByPost($pid)
    // {
    //     return $this->select($this->select)
    //                 ->join('t_post', 'post_pk = comment_fk_post')
    //                 ->join('t_user', 'comment_fk_user = user_pk')
    //                 ->where('post_pk', $pid)
    //                 ->findAll();
    // }

    // public function getAllByKeyword($keyword)
    // {
    //     return $this->select($this->select . 'post_pk as pid')
    //                 ->join('t_post', 'post_pk = comment_fk_post')
    //                 ->join('t_user', 'comment_fk_user = user_pk')
    //                 ->like('comment_text', $keyword)
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