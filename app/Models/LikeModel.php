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
    protected $useTimestamps = false;
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/