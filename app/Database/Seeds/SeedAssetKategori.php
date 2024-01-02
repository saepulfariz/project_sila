<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssetKategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Asset Bergerak',
            ],
            [
                'nama_kategori' => 'Asset Mati',
            ],
        ];


        $this->db->table('tb_asset_kategori')->insertBatch($data);
    }
}
