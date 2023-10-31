<?php

namespace App\Controllers;

/**
 * @property db $db
 */

class Akun1 extends BaseController
{
  public function index(): string
  {
    $builder = $this->db->table('akun1s');
    $query = $builder->get();

    $query = $this->db->query("SELECT * FROM akun1s");
    $data['akun1Data'] = $query->getResult();
    return view('akun1/index', $data);
  }
}
