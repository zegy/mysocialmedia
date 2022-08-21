<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table      = 'home_view'; // in this case, it's a view, not a real table
    protected $primaryKey = 'pid';
    protected $returnType = 'object';
        
    public function publicPosts()
    {
        $data = $this->where('type', 'public');
        return $data;
    }

    public function privatePosts()
    {
        $data = $this->where('type', 'private');
        return $data;
    }
}
