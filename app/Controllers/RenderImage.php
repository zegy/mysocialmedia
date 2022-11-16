<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class RenderImage extends Controller
{
    public function index($imageName)
    {
        if(($image = file_get_contents(WRITEPATH.'uploads/posts/' . $imageName)) === FALSE)
            show_404();

        // choose the right mime type
        $mimeType = 'image/jpg';

        $this->response
            ->setStatusCode(200)
            ->setContentType($mimeType)
            ->setBody($image)
            ->send();

    }

}