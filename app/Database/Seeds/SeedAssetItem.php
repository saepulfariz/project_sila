<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssetItem extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_item' => 'CHR2312170001',
                'id_barang' => 1,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'CHR2312170002',
                'id_barang' => 1,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'CHR2312170003',
                'id_barang' => 1,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'CHR2312170004',
                'id_barang' => 1,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'MJ12312170001',
                'id_barang' => 2,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'MJ12312170002',
                'id_barang' => 2,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'INF2312170001',
                'id_barang' => 3,
                'id_status' => 1,
            ],
            [
                'kode_item' => 'INF2312170002',
                'id_barang' => 3,
                'id_status' => 1,
            ],
        ];


        $this->db->table('tb_asset_item')->insertBatch($data);
    }
}
