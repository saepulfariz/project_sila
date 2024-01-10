<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbHelpdesk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_helpdesk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
            ],
            'nama_dosen' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'catatan' => [
                'type'           => 'TEXT',
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

        $this->forge->addKey('id_helpdesk', true);
        $this->forge->addForeignKey('cid', 'tb_user', 'id_user');
        $this->forge->addForeignKey('id_kategori', 'tb_helpdesk_kategori', 'id_kategori');
        $this->forge->addForeignKey('id_status', 'tb_status', 'id_status');
        $this->forge->createTable('tb_helpdesk');
    }

    public function down()
    {
        $this->forge->dropTable('tb_helpdesk');
    }
}
