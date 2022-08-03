<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\I18n\Time;
use App\Models\HomeModel;

class Post extends BaseController
{
    function __construct() 
    {             
        helper('form');
        $this->db = \Config\Database::connect();
        $this->session = session();    
        $this->postModel = new PostModel();
        $this->homeModel = new HomeModel();
    }
    
    public function save() 
    {
        $data   = $this->request->getPost();

        if ( !isset($data) || empty($data) )
        {       
            throw new \CodeIgniter\Exceptions\PageNotFoundException();   
        } 
                  
        $myTime = new Time('now', 'America/Recife', 'pt_BR');
        
        if ( isset($data["user_id"]) && session()->get('id') != $data["user_id"] )
        {      
            return redirect()->to('/');
        }
          
        if (isset($data["post_id"]) && isset($data["text"])) //update post
        {   
            $dataToSave =
            [
                "post_pk"   => $data["post_id"],
                "post_text" => $data["text"]
            ]; 
        }
        else if ( isset( $data["user_id"]) &&  $data["text"] ) //new post
        {   
            $dataToSave =
            [
                "post_fk_user"   => $data["user_id"], 
                "post_text"      => $data["text"],
                "post_date_time" => ((array)$myTime)['date']
            ]; 
        }
        else
        {
            return redirect()->to('/');
        }
       
        $request = $this->postModel->save($dataToSave);
        
        if ($request)
        {
            return redirect()->to('/');
        }
        else
        {
            echo view('erro');
        }
    }

    public function delete(int $pid) // post id / pid
    {
        if (!$pid)
        {       
            throw new \CodeIgniter\Exceptions\PageNotFoundException();    
        }
        
        if ( $this->postModel->checkOwnership( $pid, session()->get('id') ) )
        {
            if ($this->postModel->delete($pid))
            {
                return redirect()->to('/');
            }
            else
            {
                return redirect()->to('/'); 
            }
        }
        else
        {
            return redirect()->to('/');
        }
    }

    public function edit($pid) // problem with return type here!
    {
        if (!$pid)
        {        
            throw new \CodeIgniter\Exceptions\PageNotFoundException();     
        }
          
        $post = $this->postModel->where('post_pk', (int)$pid)->first();
             
        if(session()->get('id') == $post['post_fk_user'])
        {         
            echo view('/common/edit', [ 'post' => $post ] );        
        }
        else
        {         
            return redirect()->to('/');        
        }
    }

    public function userPosts($uid) // list all post from specific user
    {    
        echo view("profile/myposts",
        [
            "posts" => $this->homeModel->where('uid', $uid)->paginate(5), // paginate with where
            "pager" => $this->homeModel->pager
        ]);                 
    }
}