<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_item' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_status' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('id_item', true);
        $this->forge->addForeignKey('id_barang', 'tb_asset_barang', 'id_barang');
        $this->forge->addForeignKey('id_status', 'tb_asset_status', 'id_status');
        $this->forge->createTable('tb_asset_item');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_item');
    }
}
