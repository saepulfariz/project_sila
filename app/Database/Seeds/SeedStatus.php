<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedStatus extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_status' => 'Pending',
            ],
            [
                'nama_status' => 'Done',
            ],
            [
                'nama_status' => 'Reject',
            ],
        ];


        $this->db->table('tb_status')->insertBatch($data);
    }
}
