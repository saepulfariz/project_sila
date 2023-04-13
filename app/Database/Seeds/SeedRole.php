<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedRole extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_role' => 'admin',
            ],
            [
                'nama_role' => 'staff',
            ],
            [
                'nama_role' => 'pimpinan',
            ],
            [
                'nama_role' => 'mahasiswa',
            ],
        ];


        $this->db->table('tb_role')->insertBatch($data);
    }
}
