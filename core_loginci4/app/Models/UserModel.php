<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table      = 'user';
    protected $useTimestamps = true;

    // protected $allowedFields = ['nama', 'email', 'password', 'role_id', 'is_active', 'image'];

    // protected $primaryKey = 'id_user';

    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;


    public function cekuser($email)
    {
        $hasil = $this->table($this->table)->where('email', $email)->get()->getRowArray();

        return $hasil;
    }
}
