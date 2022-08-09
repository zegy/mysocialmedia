<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table      = 'home_view'; // in this case, it's a view, not a real table
    protected $primaryKey = 'pid';
    protected $returnType = 'object';
        
    public function dosenPosts() 
    {
        $data = $this->where('role', 'dosen');
        return $data;
    }

    public function mahasiswaPosts() 
    {
        $data = $this->where('role', 'mahasiswa');
        return $data;
    }
}
