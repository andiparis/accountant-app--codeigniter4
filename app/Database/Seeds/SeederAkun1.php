<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun1 extends Seeder
{
  public function run()
  {
    $data = [
      [
        'kode_akun1'  => 1,
        'nama_akun1'  => 'Aktiva',
      ],
      [
        'kode_akun1'  => 2,
        'nama_akun1'  => 'Modal',
      ],
    ];
    $this->db->table('akun1s')->insertBatch($data);
  }
}
