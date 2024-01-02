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
        $this->call('SeedAssetStatus');
        $this->call('SeedAssetPinjamStatus');
        $this->call('SeedAssetKategori');
        $this->call('SeedAssetBarang');
        $this->call('SeedAssetItem');
    }
}
