<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssetPinjamStatus extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_status' => 'Reject',
            ],
            [
                'nama_status' => 'Pending',
            ],
            [
                'nama_status' => 'Pinjam',
            ],
            [
                'nama_status' => 'Kembali',
            ],
        ];


        $this->db->table('tb_asset_pinjam_status')->insertBatch($data);
    }
}
