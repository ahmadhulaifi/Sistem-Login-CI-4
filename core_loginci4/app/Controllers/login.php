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
            $password = $this->request->getVar('password');

            // $data = [
            //     'email' => $email,
            //     'password' => $password
            // ];

            $ceklog = $this->loginModel->cekLog($email);

            if (password_verify($password, $ceklog['password'])) {
                // jika user sudah verifikasi
                if ($ceklog['is_active'] == 1) {
                    $data = [
                        'success' => true,
                        'responce' => 'yes',
                    ];
                    $user = [
                        'email' => $ceklog['email'],
                        'nama' => $ceklog['nama'],
                        'role_id' => $ceklog['role_id'],
                        'image' => $ceklog['image'],
                        'created_at' => $ceklog['created_at'],
                        'updated_at' => $ceklog['updated_at']
                    ];
                    session()->set($user);
                } else {
                    session()->setFlashdata('pesanError', 'Email belum verifikasi');
                    $data['success'] = true;
                    $data['responce'] = 'not';
                }
            } else {
                session()->setFlashdata('pesanError', 'Email tidak terdaftar / tidak sesuai');
                $data['success'] = true;
                $data['responce'] = 'not';
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
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 0,
                'image' => 'default.png'
            ];

            $save = $this->loginModel->save($data);
            session()->setFlashdata('pesan', 'Register berhasil<br>silahkan verifikasi di email.');
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

    public function logout()
    {
        // session()->destroy();
        unset($_SESSION['email']);
        unset($_SESSION['nama']);
        unset($_SESSION['role_id']);
        session()->setFlashdata('pesan', 'Anda berhasil logout.');
        return redirect()->to(base_url('/login'));
    }

    public function block()
    {
        return view('block');
    }
}
