<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table = 'user_sub_menu';

    // protected $useTimestamps = true;
    protected $allowedFields = ['sub_menu', 'menu_id', 'url', 'icon', 'is_active'];


    // protected $primaryKey = 'id_user';

    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getSubMenu()
    {
        $query = $this->table($this->table)->select('user_sub_menu.id,user_sub_menu.sub_menu,menu,url,user_sub_menu.icon,is_active')->join('user_menu', 'user_sub_menu.menu_id = user_menu.id')->get()->getResultArray();

        return $query;
    }

    public function deletesub($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $result = $builder->delete();

        return $result;
    }
}
