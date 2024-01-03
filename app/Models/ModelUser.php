<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
  // protected $useAutoIncrement = true;
  // protected $useSoftDeletes   = false;
  // protected $protectFields    = true;
  protected $table            = 'users';
  protected $primaryKey       = 'id';
  protected $returnType       = 'object';
  protected $allowedFields    = ['email', 'username', 'fullname', 'password_hash', 'active'];

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

  public function getTotalUser()
  {
    $query = $this->db->table('users');

    return $query->countAll();
  }

  public function getAllUsers()
  {
    $query = $this->db->table('users AS usr')
      ->join('auth_groups_users AS grp_usr', 'grp_usr.user_id = usr.id', 'left')
      ->join('auth_groups AS grp', 'grp.id = grp_usr.group_id', 'left')
      ->select('usr.id, email, username, fullname, name AS role');

    return $query->get()->getResultObject();
  }

  public function getAllRoles()
  {
    $query = $this->db->table('auth_groups');
    return $query->get()->getResultObject();
  }

  public function getUserById($id)
  {
    $query = $this->db->table('users AS usr')
      ->join('auth_groups_users AS grp_usr', 'grp_usr.user_id = usr.id')
      ->select('id, email, username, fullname, group_id')
      ->where('usr.id', $id);

    return $query->get()->getRowObject();
  }
}
