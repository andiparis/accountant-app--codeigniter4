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

    // $query = $this->db->query("SELECT * FROM akun1s");
    $data['akun1Data'] = $query->getResult();
    return view('akun1/index', $data);
  }

  public function new()
  {
    return view('akun1/new');
  }

  public function store()
  {
    $data = $this->request->getPost();
    $data = [
      'kode_akun1'  => $this->request->getVar('kode_akun1'),
      'nama_akun1'  => $this->request->getVar('nama_akun1'),
    ];
    $this->db->table('akun1s')->insert($data);
    return redirect()->to(site_url('akun1'))->with('success', 'Data berhasil di simpan');
  }
}
