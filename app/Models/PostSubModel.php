<?php

namespace App\Models;

use CodeIgniter\Model;

class PostSubModel extends Model
{
    protected $table         = 't_post_sub';
    protected $primaryKey    = 'post_sub_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'post_sub_fk_post',
        'post_sub_fk_user'
    ];
    protected $useTimestamps = false;

    //NOTE Custom var with "standard query" string (instead of CI's Model and Query Builder)
    protected $selected = '
        user_token
    ';

    public function getAllWithToken($pid)
    {
        return $this->select($this->selected)
                    ->join('t_user', 'post_sub_fk_user = user_pk')
                    ->join('t_post', 'post_sub_fk_post = post_pk')
                    ->where([
                        'post_sub_fk_post' => $pid,
                        'user_token !=' => '' //EXPERIMENTAL!. "null" is not working
                    ])
                    ->get()
                    ->getResult();
    }
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/