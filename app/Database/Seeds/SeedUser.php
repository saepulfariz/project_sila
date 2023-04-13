<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeedUser extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'npm' => 'D1A200027',
                'email'    => 'admin@mail.com',
                'nama_lengkap'    => 'administrator',
                'no_hp' => '082216501151',
                'is_active' => 1,
                'id_role' => 1,
                'cid' => 1,
                'uid' => 1,
                'created_at' => '2023-04-13 14:15:00.000',
                'updated_at' => '2023-04-13 14:15:00.000',
            ],
            [
                'username' => 'staff',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'npm' => 'D1A200029',
                'email'    => 'staffn@mail.com',
                'nama_lengkap'    => 'staff',
                'no_hp' => '082216501151',
                'is_active' => 1,
                'id_role' => 2,
                'cid' => 1,
                'uid' => 1,
                'created_at' => '2023-04-13 14:15:00.000',
                'updated_at' => '2023-04-13 14:15:00.000',
            ],
            [
                'username' => 'pimpinan',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'npm' => 'D1A200032',
                'email'    => 'pimpinan@mail.com',
                'nama_lengkap'    => 'pimpinan',
                'no_hp' => '082216501151',
                'is_active' => 1,
                'id_role' => 3,
                'cid' => 1,
                'uid' => 1,
                'created_at' => '2023-04-13 14:15:00.000',
                'updated_at' => '2023-04-13 14:15:00.000',
            ],

        ];

        $this->db->table('tb_user')->insertBatch($data);
    }
}
