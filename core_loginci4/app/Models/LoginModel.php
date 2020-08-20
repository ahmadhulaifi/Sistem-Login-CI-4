<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'email', 'password', 'role_id', 'is_active', 'image'];

    // protected $primaryKey = 'id_user';

    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function cekLog($email)
    {
        $query = $this->table($this->table)->where('email', $email)->countAll();

        if ($query > 0) {
            $hasil = $this->table($this->table)->where('email', $email)->limit(1)->get()->getRowArray();
        } else {
            $hasil = '';
        }

        return $hasil;
    }
}
