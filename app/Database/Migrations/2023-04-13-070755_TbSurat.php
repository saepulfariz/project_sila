<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_surat' => [
                'type'       => 'VARCHAR',
                'constraint'     => '128',
            ],
            'no_surat' => [
                'type'       => 'VARCHAR',
                'constraint'     => '128',
            ],
            'perihal' => [
                'type'       => 'TEXT',
                'null' => true
            ],
            'kepada' => [
                'type'       => 'VARCHAR',
                'constraint'     => '128',
                'null' => true
            ],
            'file_surat' => [
                'type'       => 'VARCHAR',
                'constraint'     => '128',
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'id_status' => [
                'type'           => 'INT',
                'constraint'     => 11,
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

        $this->forge->addKey('id_surat', true);
        $this->forge->createTable('tb_surat');
    }

    public function down()
    {
        $this->forge->dropTable('tb_surat');
    }
}
