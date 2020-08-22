<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\SubmenuModel;


class Menu extends BaseController
{

    protected $userModel;
    protected $menuModel;
    protected $submenuModel;

    public function __construct()
    {


        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }

    public function index()
    {

        $cekuser = $this->userModel->cekuser(session('email'));

        $me = $this->menuModel->findAll();
        $data = [
            'title' => 'Menu Management',
            'user' => $cekuser,
            'menu' => $me,
            'validation' => \Config\Services::validation()
        ];


        return view('admin/menu/index', $data);
    }

    public function addmenu()
    {
        if (!$this->validate([
            'tambahMenu' => [
                'rules' => 'required|is_unique[user_menu.menu]',
                'errors' => [
                    'required' => 'Menu tidak boleh kosong',
                    'is_unique' => 'Data Menu sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            return redirect()->to(base_url('/menu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sukses
            $menu = $this->request->getVar('tambahMenu');
            $icon = $this->request->getVar('menuIcon');
            $insert = [
                'menu' => $menu,
                'icon' => $icon
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil ditambah');
            $this->menuModel->insert($insert);
            return redirect()->to(base_url('/menu'));
        }
    }

    public function submenu()
    {
        $cekuser = $this->userModel->cekuser(session('email'));


        $submenu = $this->submenuModel->getSubMenu();
        $menu = $this->menuModel->findAll();


        $data = [
            'title' => 'Submenu Management',
            'user' => $cekuser,
            'submenu' => $submenu,
            'menu' => $menu,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/menu/submenu', $data);
    }

    public function saveSubmenu()
    {
        $cekuser = $this->userModel->cekuser($_SESSION['email']);
        $submenu = $this->submenuModel->getSubMenu();
        $menu = $this->menuModel->findAll();

        $data = [
            'title' => 'Submenu Management',
            'user' => $cekuser,
            'submenu' => $submenu,
            'menu' => $menu,
            'validation' => \Config\Services::validation()
        ];

        if (!$this->validate([
            'submenu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Submenu tidak boleh kosong'
                ]
            ],
            'menu_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Menu tidak boleh kosong'
                ]
            ],
            'url' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Url tidak boleh kosong'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon tidak boleh kosong'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();


            session()->setFlashdata('pesanError', $data['validation']->listErrors());
            return redirect()->to(base_url('menu/submenu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sub menu sukses
            $submenu = $this->request->getVar('submenu');
            $menu_id = $this->request->getVar('menu_id');
            $url = $this->request->getVar('url');
            $icon = $this->request->getVar('icon');
            $is_active = $this->request->getVar('is_active');

            $insert = [
                'sub_menu' => $submenu,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil ditambah');
            $this->submenuModel->insert($insert);
            return redirect()->to(base_url('/menu/submenu'));
        }
    }
}
