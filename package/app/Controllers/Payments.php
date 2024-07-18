<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use CodeIgniter\HTTP\ResponseInterface;

class Payments extends BaseController
{
    public function index()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Payments',
            'userInfo' => $userInfo
        ];
        return view('payments/index', $data);
    }

    public function registration()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Registration',
            'userInfo' => $userInfo
        ];
        return view('payments/registration', $data);
    }

    public function route()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Route Application',
            'userInfo' => $userInfo
        ];
        return view('payments/route', $data);
    }

    public function savings()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Savings',
            'userInfo' => $userInfo
        ];
        return view('payments/savings', $data);
    }

    public function operations()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Operations',
            'userInfo' => $userInfo
        ];
        return view('payments/operations', $data);
    }

    public function loans()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Loans',
            'userInfo' => $userInfo
        ];
        return view('payments/loan', $data);
    }

    public function insurance()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Insurance',
            'userInfo' => $userInfo
        ];
        return view('payments/insurance', $data);
    }

    public function welfare()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Welfare',
            'userInfo' => $userInfo
        ];
        return view('payments/welfare', $data);
    }

    public function tyres()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Tyres',
            'userInfo' => $userInfo
        ];
        return view('payments/tyres', $data);
    }

    public function miscellaneous()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Miscellaneous',
            'userInfo' => $userInfo
        ];
        return view('payments/miscellaneous', $data);
    }

}
