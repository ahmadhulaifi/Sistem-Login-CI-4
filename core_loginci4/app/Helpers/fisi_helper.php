<?php


function checkaccess($role_id, $menu_id)
{
    $db      = \Config\Database::connect();

    $builder = $db->table('user_access_menu');

    $builder->where('role_id', $role_id);
    $builder->where('menu_id', $menu_id);

    // $query   = $builder->get();
    // dd($query);
    if ($builder->countAllResults() > 0) {
        return "checked='checked'";
    }
}
