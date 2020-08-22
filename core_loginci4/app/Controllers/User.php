<?php


namespace App\Controllers;

use App\Models\UserModel;


class User extends BaseController
{

    protected $userModel;

    public function __construct()
    {

        $this->userModel = new UserModel();
    }


    public function index()
    {

        // $cekuser = $this->userModel->cekuser(session('email'));
        $cekuser = $this->userModel->cekuser(session('email'));
        $data = [
            'title' => 'Dashboard',
            'user' => $cekuser
        ];

        return view('admin/dashboard', $data);
    }
}
