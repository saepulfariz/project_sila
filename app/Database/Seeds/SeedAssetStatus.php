<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssetStatus extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_status' => 'Ada',
            ],
            [
                'nama_status' => 'Hilang',
            ],
            [
                'nama_status' => 'Pinjam',
            ],
            [
                'nama_status' => 'Rusak',
            ],
            [
                'nama_status' => 'Kembali',
            ],
        ];


        $this->db->table('tb_asset_status')->insertBatch($data);
    }
}
