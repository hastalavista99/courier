<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\SendSMS;
use App\Models\AuthModel;
use App\Models\DestinationsModel;
use App\Libraries\Hash;
use App\Models\PackagesModel;
use App\Models\SmsModel;
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
        foreach ($packages as &$package) {
            if ($package['status'] == 'Dispatched') {
                $package['button_text'] = 'Receive';
            } else {
                $package['button_text'] = 'Received';
            }
        }

        $data = [
            'title' => 'Incoming',
            'userInfo' => $userInfo,
            'packages' => $packages,
        ];
        return view('incoming/index', $data);
    }

    public function show()
    {
        helper(['form', 'url']);
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packageId = $this->request->getGet('pid');
        $origin = esc($this->request->getGet('origin'));
        $destination = esc($this->request->getGet('destination'));

        $package = $packageModel->find($packageId);

        // Ensure the package exists
        if (!$package) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        $data = [
            'title' => 'Package Details',
            'userInfo' => $userInfo,
            'package' => $package,
            'origin' => $origin,
            'destination' => $destination,

        ];

        return view('incoming/show', $data);
    }

    public function outshow()
    {
        helper(['form', 'url']);
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packageId = $this->request->getGet('pid');
        $origin = esc($this->request->getGet('origin'));
        $destination = esc($this->request->getGet('destination'));

        $package = $packageModel->find($packageId);
        // Ensure the package exists
        if (!$package) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        $data = [
            'title' => 'Package Details',
            'userInfo' => $userInfo,
            'package' => $package,
            'origin' => $origin,
            'destination' => $destination,

        ];

        return view('outgoing/show', $data);
    }

    public function historyView()
    {
        helper(['form', 'url']);
        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packageId = $this->request->getGet('pid');
        $origin = esc($this->request->getGet('origin'));
        $destination = esc($this->request->getGet('destination'));

        $package = $packageModel->find($packageId);

        // Ensure the package exists
        if (!$package) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Package not found');
        }

        $data = [
            'title' => 'Package Details',
            'userInfo' => $userInfo,
            'package' => $package,
            'origin' => $origin,
            'destination' => $destination,

        ];

        return view('dashboard/show', $data);
    }

    public function outgoing()
    {

        $userModel = new AuthModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $packageModel = new PackagesModel();
        $packages = $packageModel->outgoing($loggedInUserId);

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
        $recipientSms = $this->request->getPost('recipientSms');
        $senderSms = $this->request->getPost('senderSms');

        // Determine payment status
        $pesa = ($paid == 'paid') ? 'Yes' : 'No';

        // Determine recipient SMS status
        $recipientSmsStatus = ($recipientSms == 'recipientSms') ? 'Yes' : 'No';

        // Determine sender SMS status
        $senderSmsStatus = ($senderSms == 'senderSms') ? 'Yes' : 'No';

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
            'senderSms' => $senderSmsStatus,
            'recipientSms' => $recipientSmsStatus,
        ];

        $query = $packageModel->save($data);
        if (!$query) {
            return redirect()->back()->with('fail', 'Saving Package Failed');
        } else {
            if ($senderSmsStatus == 'Yes') {

                $msg = "Hi $sender, your package is en route to its destination, you will be notified when it arrives";
                $mobile = $senderMobile;
                $sms = new SendSMS();
                $sms->sendSMS($mobile, $msg);
            }
            if ($recipientSmsStatus == 'Yes') {
                $msg = "Hi $recipient, your package is on its way, you will be notified
                when it arrives";
                $mobile = $recipientMobile;
                $sms = new SendSMS();
                $sms->sendSMS($mobile, $msg);
            }

            return redirect()->back()->with('success', 'Package Saved Successfully');
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

    public function incomingPackage()
    {

        helper(['form', 'url']);

        $destinationModel = new AuthModel();
        $packageId = $this->request->getGet('id');
        $packageModel = new PackagesModel();
        $data = [
            'status' => 'Received',
        ];

        log_message('debug', 'Package ID: ' . print_r($packageId, true));
log_message('debug', 'Data: ' . print_r($data, true));
        
        $query = $packageModel->update($packageId, $data); // Update the data using the ID directly
        

        $package = $packageModel->find($packageId);
        $destination = $package['destination_id'];
        $destinationData = $destinationModel->find($destination);
        if (!$query) {
            return redirect()->back()->with('fail', 'Something went wrong.');
        } else {
            // if ($package['senderSms'] == 'Yes') {

            //     $msg = "Hi " . $package['sender'] . ", your package " . $package['unique_id'] . " has arrived in " . $destinationData['username'];
            //     $mobile = $package['sender_mobile'];
            //     $sms = new SendSMS();
            //     $sms->sendSMS($mobile, $msg);
            // }
            // if ($package['recipientSms'] == 'Yes') {
            //     $msg = "Hi " . $package['recipient'] . ", your package " . $package['unique_id'] . " has arrived in " . $destinationData;
            //     $mobile = $package['recipient_mobile'];
            //     $sms = new SendSMS();
            //     $sms->sendSMS($mobile, $msg);
            // }
            return redirect()->back()->with('success', 'Successfully received package!');
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
