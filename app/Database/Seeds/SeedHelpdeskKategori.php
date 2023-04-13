<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedHelpdeskKategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Fasilitas (Kerusakan Kursi)',
            ],
            [
                'nama_kategori' => 'Pelayanan BAAK',
            ],
            [
                'nama_kategori' => 'Dosen',
            ],
            [
                'nama_kategori' => 'Perkuliahan',
            ],
        ];


        $this->db->table('tb_helpdesk_kategori')->insertBatch($data);
    }
}
