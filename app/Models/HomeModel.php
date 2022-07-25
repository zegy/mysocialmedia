<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table      = 'home_view'; // in this case, it's a view, not a real table
    protected $primaryKey = 'pid';
    protected $returnType = 'object';
 // protected $allowedFields = [ ];
    
    
    
    public function getHomePosts() : array 
    {
        
        $rq = $this->findAll();  
        
        return !is_null($rq) ? $rq : [];
    }
        
    
    
}
