<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelStatus extends Model
{
  // protected $useAutoIncrement = true;
  // protected $useSoftDeletes   = false;
  // protected $protectFields    = true;
  protected $table            = 'status';
  protected $primaryKey       = 'id_status';
  protected $returnType       = 'object';
  protected $allowedFields    = ['status'];

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
}
