<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Login | Fisiartsolution',
            'halaman' => 'Halaman Login'
        ];

        return view('login/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register | Fisiartsolution',
            'halaman' => 'Halaman Register'
        ];

        return view('login/register', $data);
    }

    public function lupaPassword()
    {
        $data = [
            'title' => 'Lupa Pass | Fisiartsolution',
            'halaman' => 'Halaman Lupa password'
        ];

        return view('login/lupa', $data);
    }
}
