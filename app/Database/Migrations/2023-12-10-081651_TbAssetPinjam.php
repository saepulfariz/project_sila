<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetPinjam extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjam' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_pinjam' => [
                'type'       => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tgl_pinjam' => [
                'type'       => 'DATE',
            ],
            'jatuh_tempo' => [
                'type'       => 'DATE',
            ],
            'tgl_kembali' => [
                'type'       => 'DATE',
            ],
            'perihal' => [
                'type'       => 'TEXT',
            ],
            'catatan' => [
                'type'       => 'TEXT',
            ],
            'id_status' => [
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
        $this->forge->addKey('id_pinjam', true);
        $this->forge->addKey('kode_pinjam', false);
        $this->forge->addForeignKey('cid', 'tb_user', 'id_user');
        $this->forge->addForeignKey('id_status', 'tb_asset_pinjam_status', 'id_status');
        $this->forge->createTable('tb_asset_pinjam');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_pinjam');
    }
}
