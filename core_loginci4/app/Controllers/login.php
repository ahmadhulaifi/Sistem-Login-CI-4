<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Validation\Validation;

class Login extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    // controller untuk login
    public function index()
    {

        $data = [
            'title' => 'Login | Fisiartsolution',
            'halaman' => 'Halaman Login'
        ];

        return view('login/login', $data);
    }

    public function cekLogin()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'email harus diisi',
                    'valid_email' => 'format email tidak sesuai'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            $valid = [
                'email' => $validation->getError('email'),
                'password' => $validation->getError('password'),
            ];

            $data = [
                'success' => false,
                'validation' => $valid
            ];
        } else {
            // validasi sukses
            $email = $this->request->getVar('email');
            // $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $password = md5($this->request->getVar('password'));

            $data = [
                'email' => $email,
                // 'password' =>  password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                'password' => $password
            ];

            $user = $this->loginModel->where('email', $email)->where('password', $password)->findAll();
            $jumlah = $this->loginModel->where('email', $email)->where('password', $password)->countAllResults();

            if ($jumlah > 0) {
                // user ada
                $data = [
                    'success' => true,
                    'responce' => 'yes',
                    'jumlah' => $jumlah,
                    'user' => $user
                ];
            } else {
                session()->setFlashdata('pesanError', 'Email tidak terdaftar / tidak sesuai');
                $data['success'] = true;
                $data['responce'] = 'not';
                $data['jumlah'] = $jumlah;
                $data['user'] = $user;
            }
        }

        return json_encode($data);
    }


    // controller untuk register
    public function register()
    {

        $data = [
            'title' => 'Register | Fisiartsolution',
            'halaman' => 'Halaman Register',
            'validation' => \Config\Services::validation()
        ];

        return view('login/register', $data);
    }


    function saveRegister()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "nama harus diisi"
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'email harus diisi',
                    'valid_email' => 'format email tidak sesuai',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|matches[passwordRepeat]',
                'errors' => [
                    'required' => 'password harus diisi',
                    'min_length' => 'password kurang dari 5 karakter',
                    'matches' => 'password tidak sesuai'
                ]
            ],
            'passwordRepeat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            $valid = [
                'nama' => $validation->getError('nama'),
                'email' => $validation->getError('email'),
                'password' => $validation->getError('password'),
                'passwordRepeat' => $validation->getError('passwordRepeat')
            ];

            $data = [
                'success' => false,
                'validation' => $valid
            ];
        } else {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
                'password' => md5($this->request->getVar('password')),
                'role_id' => 1,
                'is_active' => 1,
                'image' => 'default.jpg'
            ];

            $save = $this->loginModel->save($data);
            session()->setFlashdata('pesan', 'Register berhasil<br>silahkan login.');
            $data = [
                'success' => true,
                'data' => $save,
                // 'msg' => session()->setFlashdata('pesan', 'Register berhasil<br>silahkan login.')
            ];
        }


        // return $this->response->setJSON($data);
        echo json_encode($data);
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
