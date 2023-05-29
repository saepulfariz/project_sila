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

        $this->forge->addKey('id_helpdesk', true);
        $this->forge->createTable('tb_helpdesk');
    }

    public function down()
    {
        $this->forge->dropTable('tb_helpdesk');
    }
}
