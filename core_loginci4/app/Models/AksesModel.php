<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model
{
    protected $table = 'user_access_menu';

    // protected $useTimestamps = true;
    protected $allowedFields = ['role_id', 'menu_id'];


    // protected $primaryKey = 'id_user';

    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function cekakses($id)
    {
        $query = $this->table($this->table)->where('role_id', $id)->get()->getResultArray();
        // dd($query);
        return $query;
    }

    public function cekmember($id)
    {
        $builder = $this->table($this->table);
        $builder->select('*');
        $builder->join('user_role', 'user_role.id = user_access_menu.role_id');
        $builder->where('user_role.id', $id);
        $query = $builder->get()->getRowArray();
        // dd($query);
        return $query;
    }

    public function gantiakses($role_id, $menu_id)
    {
        $query = $this->table($this->table)->select('*')->where('role_id', $role_id)->where('menu_id', $menu_id);

        if ($query->countAllResults() < 1) {
            $data = [
                'role_id' => $role_id,
                'menu_id'  => $menu_id
            ];

            return $this->table($this->table)->insert($data);
        } else {
            return $this->table($this->table)->where('role_id', $role_id)->where('menu_id', $menu_id)->delete();
        }
    }
}
