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
                'null' => true
            ],
            'uid' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
        $this->forge->createTable('tb_asset_pinjam');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_pinjam');
    }
}
