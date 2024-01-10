<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetTransaksi extends Migration
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
            'deskripsi' => [
                'type'       => 'TEXT',
            ],
            'tgl_transaksi' => [
                'type'       => 'DATE',
            ],
            'id_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_status' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_penanggung_jawab' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'cid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
            ],
            'uid' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
            ],
            'created_at' => [
                'type'           => 'DATETIME',
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_penanggung_jawab', 'tb_user', 'id_user');
        $this->forge->addForeignKey('cid', 'tb_user', 'id_user');
        $this->forge->addForeignKey('id_item', 'tb_asset_item', 'id_item');
        $this->forge->addForeignKey('id_status', 'tb_asset_status', 'id_status');
        $this->forge->createTable('tb_asset_transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_transaksi');
    }
}
