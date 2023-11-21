<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederRoles extends Seeder
{
  public function run()
  {
    $data = [
      [
        'name'        => 'user',
        'description' => 'Default role',
      ],
      [
        'name'        => 'admin',
        'description' => 'Pengelola sistem',
      ],
      [
        'name'        => 'manajer',
        'description' => 'Pengelola user',
      ],
      [
        'name'        => 'direktur',
        'description' => 'Pengecekan laporan',
      ],
    ];

    $this->db->table('auth_groups')->insertBatch($data);
  }
}
