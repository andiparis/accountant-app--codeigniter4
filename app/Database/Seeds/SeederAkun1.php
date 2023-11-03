<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun1 extends Seeder
{
  public function run()
  {
    $data = [
      [
        'kode_akun1'  => 11,
        'nama_akun1'  => 'Aktiva Lancar',
      ],
      [
        'kode_akun1'  => 12,
        'nama_akun1'  => 'Aktiva Tetap',
      ],
      [
        'kode_akun1'  => 21,
        'nama_akun1'  => 'Hutang Jangka Pendek',
      ],
      [
        'kode_akun1'  => 22,
        'nama_akun1'  => 'Hutang Jangka Panjang',
      ],
      [
        'kode_akun1'  => 31,
        'nama_akun1'  => 'Modal Pemilik',
      ],
      [
        'kode_akun1'  => 32,
        'nama_akun1'  => 'Prive Pemilik',
      ],
      [
        'kode_akun1'  => 41,
        'nama_akun1'  => 'Pendapatan Usaha',
      ],
      [
        'kode_akun1'  => 42,
        'nama_akun1'  => 'Pendapatan di Luar Usaha',
      ],
      [
        'kode_akun1'  => 51,
        'nama_akun1'  => 'Beban Usaha',
      ],
      [
        'kode_akun1'  => 52,
        'nama_akun1'  => 'Beban di Luar Usaha',
      ],
    ];

    $this->db->table('akun1s')->insertBatch($data);
  }
}
