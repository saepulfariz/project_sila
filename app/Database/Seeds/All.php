<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class All extends Seeder
{
    public function run()
    {
        $this->call('SeedRole');
        $this->call('SeedUser');
        $this->call('SeedStatus');
        $this->call('SeedHelpdeskKategori');
        $this->call('SeedSuratKategori');
    }
}
