<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNilai extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_nilai'          => [
        'type'            => 'INT',
        'constraint'      => 5,
        'unsigned'        => true,
        'auto_increment'  => true,
      ],
      'id_transaksi'      => [
        'type'            => 'INT',
        'constraint'      => 5,
        'unsigned'        => true,
      ],
      'id_akun2'          => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
      ],
      'debit'             => [
        'type'            => 'FLOAT',
        'constraint'      => 12,
        'unsigned'        => true,
      ],
      'kredit'            => [
        'type'            => 'FLOAT',
        'constraint'      => 12,
        'unsigned'        => true,
      ],
      'id_status'         => [
        'type'            => 'INT',
        'constraint'      => 5,
        'unsigned'        => true,
      ],
      'created_at'        => [
        'type'            => 'DATETIME',
        'null'            => true,
      ],
      'updated_at'        => [
        'type'            => 'DATETIME',
        'null'            => true,
      ],
      'deleted_at'        => [
        'type'            => 'DATETIME',
        'null'            => true,
      ],
    ]);
    $this->forge->addKey('id_nilai', true);
    $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi');
    $this->forge->createTable('nilai');
  }

  public function down()
  {
    $this->forge->dropForeignKey('nilai', 'nilai_id_transaksi_foreign');
    $this->forge->dropTable('nilai');
  }
}
