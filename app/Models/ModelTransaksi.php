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
}
