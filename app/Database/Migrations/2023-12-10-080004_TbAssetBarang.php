<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->addForeignKey('id_kategori', 'tb_asset_kategori', 'id_kategori');
        $this->forge->createTable('tb_asset_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_barang');
    }
}
