<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedAssetBarang extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_barang' => 'CHR',
                'nama_barang' => 'Kursi',
                'id_kategori' => 1,
            ],
            [
                'kode_barang' => 'MJ1',
                'nama_barang' => 'Meja',
                'id_kategori' => 2,
            ],
            [
                'kode_barang' => 'INF',
                'nama_barang' => 'Infokus',
                'id_kategori' => 2,
            ],
        ];


        $this->db->table('tb_asset_barang')->insertBatch($data);
    }
}
