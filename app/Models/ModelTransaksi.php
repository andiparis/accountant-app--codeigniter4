<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
  // protected $useAutoIncrement = true;
  // protected $useSoftDeletes   = false;
  // protected $protectFields    = true;
  protected $table            = 'transaksi';
  protected $primaryKey       = 'id_transaksi';
  protected $returnType       = 'object';
  protected $allowedFields    = ['kwitansi', 'tanggal', 'deskripsi', 'ketjurnal'];

  // Dates
  protected $useTimestamps = true;
  // protected $dateFormat    = 'datetime';
  // protected $createdField  = 'created_at';
  // protected $updatedField  = 'updated_at';
  // protected $deletedField  = 'deleted_at';

  // Validation
  // protected $validationRules      = [];
  // protected $validationMessages   = [];
  // protected $skipValidation       = false;
  // protected $cleanValidationRules = true;

  // Callbacks
  // protected $allowCallbacks = true;
  // protected $beforeInsert   = [];
  // protected $afterInsert    = [];
  // protected $beforeUpdate   = [];
  // protected $afterUpdate    = [];
  // protected $beforeFind     = [];
  // protected $afterFind      = [];
  // protected $beforeDelete   = [];
  // protected $afterDelete    = [];

  public function getTotalTransaksi()
  {
    $query = $this->db->table('transaksi');

    return $query->countAll();
  }

  public function generateKwitansiNumber()
  {
    $query = $this->db->table('transaksi')->select('RIGHT(transaksi.kwitansi, 4) as kwitansi', FALSE)
      ->orderBy('kwitansi', 'DESC')->limit(1)->get()->getRowArray();

    if ($query == NULL) {
      $number = 1;
    } else {
      $number = intval($query['kwitansi']) + 1;
    }
    $kwitansiNumber = str_pad($number, 4, '0', STR_PAD_LEFT);

    return $kwitansiNumber;
  }

  public function getJurnalUmum($startDate, $endDate)
  {
    $query = $this->db->table('nilai')
      ->join('transaksi', 'transaksi.id_transaksi = nilai.id_transaksi')
      ->join('akun2s', 'akun2s.id_akun2 = nilai.id_akun2')
      ->orderBy('id_nilai');

    if ($startDate && $endDate) {
      $query->where('tanggal >=', $startDate)->where('tanggal <=', $endDate);
    }

    return $query->get()->getResultObject();
  }

  public function getPosting($startDate, $endDate, $akun2Id)
  {
    $query = $this->db->table('nilai')
      ->join('transaksi', 'transaksi.id_transaksi = nilai.id_transaksi')
      ->join('akun2s', 'akun2s.id_akun2 = nilai.id_akun2')
      ->orderBy('akun2s.id_akun2');

    if ($startDate && $endDate) {
      $query->where('tanggal >=', $startDate)->where('tanggal <=', $endDate)->where('nilai.id_akun2', $akun2Id);
    }

    return $query->get()->getResultObject();
  }

  public function getNeracaSaldo($startDate, $endDate)
  {
    $query = $this->db->table('nilai')
      ->join('transaksi', 'transaksi.id_transaksi = nilai.id_transaksi')
      ->join('akun2s', 'akun2s.id_akun2 = nilai.id_akun2')
      ->selectSum('debit', 'jumlah_debit')
      ->selectSum('kredit', 'jumlah_kredit')
      ->select('akun2s.kode_akun2, akun2s.nama_akun2, transaksi.tanggal, debit, kredit')
      ->groupBy('akun2s.kode_akun2');

    if ($startDate && $endDate) {
      $query->where('tanggal >=', $startDate)->where('tanggal <=', $endDate);
    }

    return $query->get()->getResultObject();
  }

  public function getNeracaLajur($startDate, $endDate)
  {
    $where = '';
    if ($startDate && $endDate) {
      $where = "WHERE transaksi.tanggal >= '" . $startDate . "' AND transaksi.tanggal <= '" . $endDate . "'";
    }

    $query = $this->db->query(
      "SELECT
        akun1.kode_akun1,
        akun2.kode_akun2,
        akun2.nama_akun2,
        transaksi.tanggal AS tanggal,
        sum(nilai.debit) AS jumlah_debit,
        sum(nilai.kredit) AS jumlah_kredit          
      FROM nilai
      JOIN transaksi ON transaksi.id_transaksi = nilai.id_transaksi
      JOIN akun2s AS akun2 ON nilai.id_akun2 = akun2.id_akun2
      JOIN akun1s AS akun1 ON akun1.id_akun1 = akun2.id_akun1
      $where
      GROUP BY akun2.kode_akun2"
    );

    return $query->getResultObject();
  }

  public function getArusKas($startDate, $endDate)
  {
    $query = $this->db->table('nilai')
      ->join('transaksi', 'transaksi.id_transaksi = nilai.id_transaksi')
      ->join('akun2s', 'akun2s.id_akun2 = nilai.id_akun2')
      ->select('akun2s.kode_akun2, akun2s.nama_akun2, transaksi.tanggal, debit, kredit, id_status, ketjurnal')
      ->where('akun2s.kode_akun2 = 1101');

    if ($startDate && $endDate) {
      $query->where('tanggal >=', $startDate)->where('tanggal <=', $endDate);
    }

    return $query->get()->getResultObject();
  }
}
