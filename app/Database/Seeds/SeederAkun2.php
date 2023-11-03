<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeederAkun2 extends Seeder
{
  public function run()
  {
    $data = [
      [
        'kode_akun2'  => 1101,
        'nama_akun2'  => 'Kas',
        'id_akun1'    => 1,
      ],
      [
        'kode_akun2'  => 1102,
        'nama_akun2'  => 'Piutang Usaha',
        'id_akun1'    => 1,
      ],
      [
        'kode_akun2'  => 1103,
        'nama_akun2'  => 'Perlengkapan Kantor ',
        'id_akun1'    => 1,
      ],
      [
        'kode_akun2'  => 1104,
        'nama_akun2'  => 'Sewa Dibayar Dimuka',
        'id_akun1'    => 1,
      ],
      [
        'kode_akun2'  => 1105,
        'nama_akun2'  => 'Asuransi Dibayar Dimuka',
        'id_akun1'    => 1,
      ],
      [
        'kode_akun2'  => 1201,
        'nama_akun2'  => 'Peralatan Kantor',
        'id_akun1'    => 2,
      ],
      [
        'kode_akun2'  => 1202,
        'nama_akun2'  => 'Akumulasi Penyusutan P.Kantor',
        'id_akun1'    => 2,
      ],
      [
        'kode_akun2'  => 1203,
        'nama_akun2'  => 'Tanah',
        'id_akun1'    => 2,
      ],
      [
        'kode_akun2'  => 2101,
        'nama_akun2'  => 'Hutang Usaha',
        'id_akun1'    => 3,
      ],
      [
        'kode_akun2'  => 2102,
        'nama_akun2'  => 'Hutang Gaji',
        'id_akun1'    => 3,
      ],
      [
        'kode_akun2'  => 2103,
        'nama_akun2'  => 'Pendapatan Diterima Dimuka',
        'id_akun1'    => 3,
      ],
      [
        'kode_akun2'  => 2201,
        'nama_akun2'  => 'Hutang Hipotek',
        'id_akun1'    => 4,
      ],
      [
        'kode_akun2'  => 2202,
        'nama_akun2'  => 'Hutang Obligasi',
        'id_akun1'    => 4,
      ],
      [
        'kode_akun2'  => 3101,
        'nama_akun2'  => 'Modal Pemilik',
        'id_akun1'    => 5,
      ],
      [
        'kode_akun2'  => 3201,
        'nama_akun2'  => 'Prive Tuan Najwan',
        'id_akun1'    => 6,
      ],
      [
        'kode_akun2'  => 4101,
        'nama_akun2'  => 'Pendapatan Jasa',
        'id_akun1'    => 7,
      ],
      [
        'kode_akun2'  => 4102,
        'nama_akun2'  => 'Pendapatan Diterima Dimuka',
        'id_akun1'    => 7,
      ],
      [
        'kode_akun2'  => 4201,
        'nama_akun2'  => 'Pendapatan Diluar Usaha',
        'id_akun1'    => 8,
      ],
      [
        'kode_akun2'  => 5101,
        'nama_akun2'  => 'Beban Gaji Karyawan',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5102,
        'nama_akun2'  => 'Beban Iklan',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5103,
        'nama_akun2'  => 'Beban Asuransi',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5104,
        'nama_akun2'  => 'Beban Telepon',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5105,
        'nama_akun2'  => 'Beban Listrik',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5106,
        'nama_akun2'  => 'Beban Sewa',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5107,
        'nama_akun2'  => 'Beban Penyusutan Peralatan Kantor',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5108,
        'nama_akun2'  => 'Beban Perlengkapan Kantor',
        'id_akun1'    => 9,
      ],
      [
        'kode_akun2'  => 5201,
        'nama_akun2'  => 'Beban Bunga',
        'id_akun1'    => 10,
      ],
    ];

    $this->db->table('akun2s')->insertBatch($data);
  }
}
