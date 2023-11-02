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
}
