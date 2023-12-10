<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbAssetStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_status', true);
        $this->forge->createTable('tb_asset_status');
    }

    public function down()
    {
        $this->forge->dropTable('tb_asset_status');
    }
}
