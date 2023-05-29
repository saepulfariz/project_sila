<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedSuratKategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'SK',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Undangan',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Permohonan',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Pengajuan',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Dokumen Lainnya',
                'is_out' => 0
            ],
            [
                'nama_kategori' => 'Surat Pengantar PKL',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Magang',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Nilai',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Penelitian Skripsi',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Observasi Tugas',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Observasi Tugas',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat SKMK Biasa',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat SKMK PNS',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Perbaikan Absensi',
                'is_out' => 1
            ],
            [
                'nama_kategori' => 'Surat Pengantar Perbaikan Nilai UTS',
                'is_out' => 1
            ],
        ];


        $this->db->table('tb_surat_kategori')->insertBatch($data);
    }
}
