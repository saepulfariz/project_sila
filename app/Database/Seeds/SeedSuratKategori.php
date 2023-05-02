<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedSuratKategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Surat Dinas',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Surat Magang',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pindah',
                'is_out' => 1
            ],
        ];


        $this->db->table('tb_surat_kategori')->insertBatch($data);
    }
}
