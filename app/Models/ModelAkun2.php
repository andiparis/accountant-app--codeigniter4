<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAkun2 extends Model
{
  // protected $useAutoIncrement = true;
  // protected $useSoftDeletes   = false;
  // protected $protectFields    = true;
  protected $table            = 'akun2s';
  protected $primaryKey       = 'id_akun2';
  protected $returnType       = 'object';
  protected $allowedFields    = ['kode_akun2', 'nama_akun2', 'kode_akun1'];

  // Dates
  // protected $useTimestamps = false;
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

  function getAkun2WithAkun1()
  {
    $builder = $this->db->table('akun2s');
    $builder->join('akun1s', 'akun2s.id_akun1 = akun1s.id_akun1');
    $query = $builder->get();
    return $query->getResult();
  }

  function getAkun1()
  {
    $query = $this->db->table('akun1s')
      ->orderBy('kode_akun1');

    return $query->get()->getResult();
  }

  function getAkun($accountType)
  {
    $query = [];

    foreach ($accountType as $key => $value) {
      $query[$key] = $this->db->query(
        "SELECT akun2s.kode_akun2 AS kode_akun, akun2s.nama_akun2 AS nama_akun, jenis_akun = null AS jenis_akun
        FROM akun1s
        JOIN akun2s ON akun1s.id_akun1 = akun2s.id_akun1
        WHERE akun1s.jenis_akun = ($key + 1)
  
        UNION
  
        SELECT kode_akun1 AS kode_akun, nama_akun1 AS nama_akun, jenis_akun
        FROM akun1s
        WHERE jenis_akun = ($key + 1)
        ORDER BY kode_akun"
      )->getResult();
    }

    return $query;
  }

  function getAkunById($id, $table, $tableField)
  {
    $query = $this->db->table($table)
      ->where($tableField, $id);

    return $query->get()->getRow();
  }
}
