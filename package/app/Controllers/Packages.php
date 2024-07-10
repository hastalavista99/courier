<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\DestinationsModel;
use App\Libraries\Hash;
use App\Models\PackagesModel;
use CodeIgniter\HTTP\ResponseInterface;

class Packages extends BaseController
{
    public function index()
    {
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packages = $packageModel->incoming($loggedInUserId);

        $data = [
            'title' => 'Incoming',
            'userInfo' => $userInfo,
            'packages' => $packages
        ];
        return view('incoming/index', $data);
    }

    public function outgoing()
    {

        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packages = $packageModel->outgoing($loggedInUserId);
        $authModel = new AuthModel();


        $data = [
            'title' => 'Outgoing',
            'userInfo' => $userInfo,
            'packages' => $packages,

        ];
        return view('outgoing/index', $data);
    }

    public function outgoingAddPage()
    {
        helper(['url', 'form']);
        $destinationModel = new DestinationsModel();
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Outgoing',
            'userInfo' => $userInfo,
            'destinations' => $userModel->findAll()
        ];

        return view('outgoing/form', $data);
    }

    public function outgoingAdd()
    {
        helper(['url', 'form']);

        $origin = esc($this->request->getGet('stage'));
        $destination = $this->request->getPost('destination');
        $sender = esc($this->request->getPost('sender'));
        $senderMobile = esc($this->request->getPost('senderMobile'));
        $recipient = esc($this->request->getPost('recipient'));
        $recipientMobile = esc($this->request->getPost('recipientMobile'));
        $fee = esc($this->request->getPost('fee'));
        $paid = $this->request->getPost('paid');
        $description = esc($this->request->getPost('description'));

        switch ($paid) {
            case 'paid':
                $pesa = 'Yes';
                break;
            
            default:
                $pesa = 'No';
                break;
        }

        $packageModel = new PackagesModel();
        $data = [
            'sender' => $sender,
            'sender_mobile' => $senderMobile,
            'recipient' => $recipient,
            'recipient_mobile' => $recipientMobile,
            'origin_id' => $origin,
            'destination_id' => $destination,
            'status' => 'Dispatched',
            'pay_amount' => $fee,
            'payment' => $pesa,
            'user_id' => $origin,
            'description' => $description,

        ];

        $query = $packageModel->save($data);
        if (!$query) {
            return redirect()->back()->with('fail', 'Saving Package Failed');
        } else {
            return redirect()->back()->with('success', 'Saved Package Successfully');
        }
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
            'destinations' => $userModel->findAll()
        ];

        return view('destinations/index', $data);
    }

    public function createDestination()
    {
        helper(['url', 'form']);

        // Validate the input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'destination' => 'required|min_length[3]|max_length[255]',
            'mobile' => 'required|numeric|min_length[10]|max_length[15]',
            'password' => 'required|min_length[5]|max_length[20]',
            'passwordConf' => 'required|min_length[5]|max_length[20]|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Return validation errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $destinationModel = new DestinationsModel();
        $authModel = new AuthModel();
        $destination = esc($this->request->getPost('destination'));
        $mobile = esc($this->request->getPost('mobile'));
        $password = esc($this->request->getPost('password'));

        $hashLib = new \App\Libraries\Hash();
        $data = [
            'role' => 'destination',
            'username' => $destination,
            'mobile' => $mobile,
            'passkey' => $hashLib::encrypt($password)
        ];

        $query = $authModel->save($data);

        if (!$query) {
            return redirect()->back()->with('fail', 'Saving Destination Failed');
        } else {
            return redirect()->back()->with('success', 'Saved Destination Successfully');
        }
    }

    public function history()
    {

        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packages = $packageModel->getPackagesWithUsernames();


        $data = [
            'title' => 'History',
            'userInfo' => $userInfo,
            'packages' => $packages,

        ];
        return view('dashboard/history', $data);
    }
}
