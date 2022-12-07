<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotifModel;

class Notif extends BaseController
{
    function __construct()
    {
        $this->notifModel = new NotifModel();
    }

    public function list() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }
        
        $notifs = $this->notifModel->getAllByCurrentUser(session('id'));
        $notif_count = $this->notifModel->countAllByCurrentUser(session('id'));
        
        if (!empty($notifs)) {
            $output = [
                'status' => true,
                'notifs' => view('notif/notif_list', ['notifs' => $notifs])
            ];
        }
        else {
            $output['status'] = false;
        }

        $output['notif_count'] = $notif_count;

        echo json_encode($output);
    }

    public function delete_all() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $notifs = $this->notifModel->where('notif_to_fk_user', session('id'))->delete();

        echo json_encode(['status' => true]);
    }

    public function delete() // AJAX
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); // This halts the current flow. https://codeigniter.com/user_guide/general/errors.html#using-exceptions
        }

        $nid   = $this->request->getPost('nid');
        $notif = $this->notifModel->find($nid);

        if ($notif->notif_to_fk_user != session('id')) {
            echo json_encode(['status' => false]);
        }
        else {
            $this->notifModel->delete($notif->notif_pk);
            echo json_encode(['status' => true]);
        }
    }

    // TODO : "create notif" is inside comment's create function! Is okay to do so?
}