<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'npm' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'id_role' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'is_active' => [
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

        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('id_role', 'tb_role', 'id_role');
        $this->forge->createTable('tb_user');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user');
    }
}
