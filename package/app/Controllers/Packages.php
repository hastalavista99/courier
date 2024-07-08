<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\DestinationsModel;
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
        helper(['url','form']);
        $destinationModel = new DestinationsModel();
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Outgoing',
            'userInfo' => $userInfo,
            'destinations' => $destinationModel->findAll()
        ];

        return view('outgoing/form', $data);
    }

    public function destinations()
    {
        helper(['url', 'form']);
        $destinationModel = new DestinationsModel();
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Destinations',
            'userInfo' => $userInfo,
            'destinations' => $destinationModel->findAll()
        ];

        return view('destinations/index', $data);
    }

    public function createDestination()
    {
        helper(['url', 'form']);

        $destinationModel = new DestinationsModel();
        $destination = esc($this->request->getPost('destination'));
        $mobile = esc($this->request->getPost('mobile'));

        // Validate the input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'destination' => 'required|min_length[3]|max_length[255]',
            'mobile' => 'required|numeric|min_length[10]|max_length[15]',
        ]);

        $data = [
            'destination' => $destination,
            'mobile' => $mobile
        ];

        $query = $destinationModel->save($data);

        if (!$query) {
            return redirect()->back()->with('fail', 'Saving Destination Failed');
        } else {
            return redirect()->back()->with('success', 'Saved Destination Successfully');
        }
    }
}
