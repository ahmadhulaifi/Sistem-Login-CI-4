<?php

namespace App\Controllers;


use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\SubmenuModel;
use App\Models\RoleModel;
use App\Models\AksesModel;


class Menu extends BaseController
{


    protected $userModel;
    protected $menuModel;
    protected $submenuModel;
    protected $roleModel;
    protected $aksesModel;

    public function __construct()
    {
        helper('fisi');
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->roleModel = new RoleModel();
        $this->aksesModel = new AksesModel();
    }


    // controller menu
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

    public function deletemenu($id)
    {
        $this->menuModel->where('id', $id)->delete();
        $this->submenuModel->where('menu_id', $id)->delete();
        $this->roleModel->where('menu_id', $id)->delete();

        session()->setFlashdata('pesan', 'Menu berhasil dihapus');
        return redirect()->to(base_url('/menu'));
    }

    public function editmenu($id)
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
            $update = [
                'menu' => $menu,
                'icon' => $icon
            ];


            session()->setFlashdata('pesan', 'Menu Berhasil ditambah');
            $this->menuModel->update($id, $update);
            return redirect()->to(base_url('/menu'));
        }
    }


    // controller submenu
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
            return redirect()->to(base_url('/menu/submenu'))->withInput()->with('validation', $validation);
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

    public function deletesubmenu($id)
    {
        $deletesub = $this->submenuModel->deletesub($id);

        session()->setFlashdata('pesan', 'Sub Menu Berhasil didelete');
        return redirect()->to(base_url('/menu/submenu'));
    }

    public function editsub($id)
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
            return redirect()->to(base_url('/menu/submenu'))->withInput()->with('validation', $validation);
        } else {
            // validasi sub menu sukses
            $submenu = $this->request->getVar('submenu');
            $menu_id = $this->request->getVar('menu_id');
            $url = $this->request->getVar('url');
            $icon = $this->request->getVar('icon');
            $is_active = $this->request->getVar('is_active');

            $update = [
                'sub_menu' => $submenu,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];


            session()->setFlashdata('pesan', 'Sub menu berhasil diupdate');
            $this->submenuModel->update($id, $update);
            // $this->submenuModel->insert($insert);
            return redirect()->to(base_url('/menu/submenu'));
        }
    }


    // controller role management
    public function role()
    {
        $cekuser = $this->userModel->cekuser(session('email'));
        $menu = $this->menuModel->findAll();
        $role = $this->roleModel->findAll();


        $data = [
            'title' => 'Role Management',
            'user' => $cekuser,
            'menu' => $menu,
            'role' => $role,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/menu/role', $data);
    }

    public function saveRole()
    {

        $cekuser = $this->userModel->cekuser(session('email'));


        $data = [
            'title' => 'Role Management',
            'user' => $cekuser,
            'validation' => \Config\Services::validation()
        ];

        if (!$this->validate([
            'role' => [
                'rules' => 'required|is_unique[user_role.role]',
                'errors' => [
                    'required' => 'Role tidak boleh kosong',
                    'is_unique' => 'Role sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();

            session()->setFlashdata('pesanError', $data['validation']->listErrors());
            return redirect()->to(base_url('/menu/role'))->withInput()->with('validation', $validation);
        } else {
            // validasi role sukses
            $role = $this->request->getVar('role');

            $insert = [
                'role' => $role
            ];

            session()->setFlashdata('pesan', 'Role Berhasil ditambah');
            $this->roleModel->insert($insert);
            return redirect()->to(base_url('menu/role'));
        }
    }

    public function roleAkses($id)
    {
        // $db      = \Config\Database::connect();
        // $builder = $db->table('users');

        $cekuser = $this->userModel->cekuser(session('email'));
        $menu = $this->menuModel->findAll();

        $userakses = $this->aksesModel->cekakses($id);
        $member = $this->aksesModel->cekmember($id);

        $data = [
            'title' => 'Role Akses',
            'user' => $cekuser,
            'menu' => $menu,
            'userakses' => $userakses,
            'member' => $member
        ];

        return view('admin/menu/roleakses', $data);
    }

    public function gantiakses()
    {
        $menu_id = $this->request->getPost('menuId');
        $role_id = $this->request->getPost('roleId');

        $this->aksesModel->gantiakses($role_id, $menu_id);

        // $data = [
        //     'role_id' => $role_id,
        //     'menu_id' => $menu_id,
        //     'result' => $result
        // ];

        session()->setFlashdata('pesan', 'Akses Berubah');
        // return json_encode($data);
    }
}
