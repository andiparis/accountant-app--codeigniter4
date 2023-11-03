<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatus extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id_status'         => [
        'type'            => 'INT',
        'constraint'      => 6,
        'unsigned'        => true,
        'auto_increment'  => true,
      ],
      'status'            => [
        'type'            => 'VARCHAR',
        'constraint'      => 50,
      ],
    ]);
    $this->forge->addKey('id_status', true);
    $this->forge->createTable('status');
  }

  public function down()
  {
    $this->forge->dropTable('status');
  }
}
