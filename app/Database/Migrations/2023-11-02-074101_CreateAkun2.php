<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkun2 extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_akun2'          => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
        'auto_increment'  => true,
      ],
      'kode_akun2'        => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
      ],
      'nama_akun2'        => [
        'type'            => 'VARCHAR',
        'constraint'      => 100,
      ],
      'id_akun1'          => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
      ],
    ]);
    $this->forge->addKey('id_akun2', true);
    $this->forge->addForeignKey('id_akun1', 'akun1s', 'id_akun1');
    $this->forge->createTable('akun2s');
  }

  public function down()
  {
    $this->forge->dropForeignKey('akun2s', 'akun2s_id_akun1_foreign');
    $this->forge->dropTable('akun2s');
  }
}
