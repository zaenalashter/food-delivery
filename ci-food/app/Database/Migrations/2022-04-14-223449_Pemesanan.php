<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemesanan extends Migration
{
    public function up()
    {
        // $this->db->enableForeignKeyChecks();
        $this->forge->addField([
            'kd_pemesanan' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'tgl_pesan' => [
                'type' => 'DATETIME',
            ],
            'total_bayar' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'latitude' => [
                'type' => 'DUOBLE',
            ],
            'longitude' => [
                'type' => 'DUOBLE',
            ],
            'id_pelanggan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1', '2','3'],
            ],

        ]);
        $this->forge->addKey('kd_pemesanan', true);
        // $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id');
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}
