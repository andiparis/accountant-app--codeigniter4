<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNilai extends Model
{
  // protected $useAutoIncrement = true;
  // protected $useSoftDeletes   = false;
  // protected $protectFields    = true;
  protected $table            = 'nilai';
  protected $primaryKey       = 'id_nilai';
  protected $returnType       = 'object';
  protected $allowedFields    = ['id_transaksi', 'id_akun2', 'debit', 'kredit', 'id_status'];

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
}
