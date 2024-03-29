<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetPinjamDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_pinjam' => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'qty' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kode_pinjam', 'tb_asset_pinjam', 'kode_pinjam');
        $this->forge->addForeignKey('id_barang', 'tb_asset_barang', 'id_barang');
        $this->forge->createTable('tb_asset_pinjam_detail');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_pinjam_detail');
    }
}
