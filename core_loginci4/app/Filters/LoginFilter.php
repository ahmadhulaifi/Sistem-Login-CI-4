<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = NULL)
    {
        $db      = \Config\Database::connect();
        // $uri = new \CodeIgniter\HTTP\URI();
        $role_id = session('role_id');
        $builder = $db->table('user_menu');
        $builder2 = $db->table('user_access_menu');

        $posisi = strpos(uri_string(), '/');
        if ($posisi == 0) {
            $uricurrent =  uri_string();
        } else {
            $urli = explode("/", uri_string());
            $uricurrent = $urli[0];
        }


        $querymenu   = $builder->where('menu', $uricurrent)->get()->getRowArray();
        $queryaccess = $builder2->where('menu_id', $querymenu['id'])->where('role_id', $role_id)->countAllResults();

        if (!session('email')) {
            return redirect()->to(base_url('/login'));
        } elseif ($queryaccess < 1) {
            // dd($uricurrent);
            return redirect()->to(base_url('/login/block'));
        }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}
