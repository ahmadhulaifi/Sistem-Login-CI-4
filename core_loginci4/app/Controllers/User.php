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

        $cekuser = $this->userModel->cekuser($_SESSION['email']);

        $data = [
            'title' => 'Dashboard | Fisiartsolution',
            'user' => $cekuser
        ];

        return view('admin/dashboard', $data);
    }
}
