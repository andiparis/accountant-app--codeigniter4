<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAkun1 extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_akun1'          => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
        'auto_increment'  => true,
      ],
      'kode_akun1'        => [
        'type'            => 'INT',
        'constraint'      => 6,
      ],
      'nama_akun1'        => [
        'type'            => 'VARCHAR',
        'constraint'      => 50,
      ],
    ]);
    $this->forge->addKey('id_akun1', true);
    $this->forge->createTable('akun1s');
  }

  public function down()
  {
    $this->forge->dropTable('akun1s');
  }
}
