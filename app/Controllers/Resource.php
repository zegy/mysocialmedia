<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Resource extends Controller
{
    public function index($file_group, $file_name) // Experimental! my simple version
    {
        return file_get_contents(WRITEPATH . 'uploads/'. $file_group . '/' . $file_name); // Read a file into a string. https://www.w3schools.com/Php/func_filesystem_file_get_contents.asp
    }

    // OTHER FORMAT
    // public function index($imageName) // https://stackoverflow.com/a/64696591
    // {
    //     if(($image = file_get_contents(WRITEPATH.'uploads/posts/' . $imageName)) === FALSE)
    //         show_404();

    //     // choose the right mime type
    //     $mimeType = 'image/jpg';

    //     $this->response
    //         ->setStatusCode(200)
    //         ->setContentType($mimeType)
    //         ->setBody($image)
    //         ->send();
    // }

    // public function index($imageName) // https://stackoverflow.com/a/71312521
    // {

    //     $filepath = WRITEPATH . 'uploads/posts/' . $imageName;

    //     $mime = mime_content_type($filepath);
    //     header('Content-Length: ' . filesize($filepath));
    //     header("Content-Type: $mime");
    //     header('Content-Disposition: inline; imageName="' . $filepath . '";');
    //     readfile($filepath);
    //     exit();

    // }
}