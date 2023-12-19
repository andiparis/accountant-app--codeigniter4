<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun1 extends Seeder
{
  public function run()
  {
    $data = [
      [
        'kode_akun1'  => 1100,
        'nama_akun1'  => 'Aktiva Lancar',
        'jenis_akun'  => 1,
      ],
      [
        'kode_akun1'  => 1200,
        'nama_akun1'  => 'Aktiva Tetap',
        'jenis_akun'  => 1,
      ],
      [
        'kode_akun1'  => 2100,
        'nama_akun1'  => 'Hutang Jangka Pendek',
        'jenis_akun'  => 2,
      ],
      [
        'kode_akun1'  => 2200,
        'nama_akun1'  => 'Hutang Jangka Panjang',
        'jenis_akun'  => 2,
      ],
      [
        'kode_akun1'  => 3100,
        'nama_akun1'  => 'Modal Pemilik',
        'jenis_akun'  => 3,
      ],
      [
        'kode_akun1'  => 3200,
        'nama_akun1'  => 'Prive Pemilik',
        'jenis_akun'  => 3,
      ],
      [
        'kode_akun1'  => 4100,
        'nama_akun1'  => 'Pendapatan Usaha',
        'jenis_akun'  => 4,
      ],
      [
        'kode_akun1'  => 4200,
        'nama_akun1'  => 'Pendapatan di Luar Usaha',
        'jenis_akun'  => 4,
      ],
      [
        'kode_akun1'  => 5100,
        'nama_akun1'  => 'Beban Usaha',
        'jenis_akun'  => 5,
      ],
      [
        'kode_akun1'  => 5200,
        'nama_akun1'  => 'Beban di Luar Usaha',
        'jenis_akun'  => 5,
      ],
    ];

    $this->db->table('akun1s')->insertBatch($data);
  }
}
