<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSuratHistory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_history' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_surat' => [
                'type'           => 'INT',
                'constraint'     => 11,
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
            'catatan' => [
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
                'unsigned'       => true,
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

        $this->forge->addKey('id_history', true);
        $this->forge->addForeignKey('cid', 'tb_user', 'id_user');
        $this->forge->addForeignKey('id_kategori', 'tb_helpdesk_kategori', 'id_kategori');
        $this->forge->addForeignKey('id_status', 'tb_status', 'id_status');
        $this->forge->createTable('tb_surat_history');
    }

    public function down()
    {
        $this->forge->dropTable('tb_surat_history');
    }
}
