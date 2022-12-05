<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifModel extends Model
{
    protected $table         = 't_notif';
    protected $primaryKey    = 'notif_pk';
    protected $returnType    = 'object';
    protected $allowedFields =
    [
        'notif_to_fk_user',
        'notif_from_fk_user',
        'notif_type'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'notif_date_time';
    protected $updatedField; //NOTE It's needed by "useTimestamps" even if we not use it. https://codeigniter.com/user_guide/models/model.html?highlight=find#usetimestamps
}

/*NOTE
    The Model does not provide a perfect interface to the Query Builder.
    The Model and the Query Builder are separate classes with different purposes.
    Example : "select()" and "join()" is part of Query Builder, "find()" and "paginate()" is part of Model.
    Query Builder methods and Model’s CRUD methods can be in the same chained call.
    https://codeigniter.com/user_guide/models/model.html?highlight=find#working-with-query-builder
*/