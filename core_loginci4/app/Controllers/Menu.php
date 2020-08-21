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

        $cekuser = $this->userModel->cekuser($_SESSION['email']);

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
        $cekuser = $this->userModel->cekuser($_SESSION['email']);


        $submenu = $this->submenuModel->getSubMenu();
        $menu = $this->menuModel->findAll();


        $data = [
            'title' => 'Submenu Management',
            'user' => $cekuser,
            'submenu' => $submenu,
            'menu' => $menu
        ];


        return view('admin/menu/submenu', $data);
    }
}
