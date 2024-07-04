<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class Packages extends BaseController
{
    public function index()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Incoming',
            'userInfo' => $userInfo
        ];
        return view('incoming/index', $data);
    }

    public function outgoing()
    {

        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Outgoing',
            'userInfo' => $userInfo
        ];
        return view('outgoing/index', $data);
    }

    public function outgoingAddPage()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Outgoing',
            'userInfo' => $userInfo
        ];

        return view('outgoing/form', $data);
    }
}
