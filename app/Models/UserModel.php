<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'username',
        'password',
        'npm',
        'nama_lengkap',
        'no_hp',
        'id_role',
        'is_active',
        'cid',
        'uid',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function cekLogin($username)
    {
        $builder  = $this->db->table($this->table);
        $builder->where('username', $username);
        $builder->orWhere('npm', $username);
        $builder->orWhere('email', $username);
        // SELECT * FROM tb_user WHERE username = username OR npm = username OR email = username
        return $builder->get()->getResultArray();
    }


    public function getRole()
    {
        return $this->db->table('tb_role')->get()->getResultArray();
    }
}
