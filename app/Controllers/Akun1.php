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

  public function edit($id = null)
  {
    if ($id != null) {
      $query = $this->db->table('akun1s')->getWhere(['id_akun1' => $id]);
      if ($query->resultID->num_rows > 0) {
        $data['akun1Data'] = $query->getRow();
        return view('akun1/edit', $data);
      } else {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      }
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  public function update($id)
  {
    $data = [
      'kode_akun1'  => $this->request->getVar('kode_akun1'),
      'nama_akun1'  => $this->request->getVar('nama_akun1'),
    ];
    $this->db->table('akun1s')->where(['id_akun1' => $id])->update($data);
    return redirect()->to(site_url('akun1'))->with('success', 'Data berhasil di update');
  }
}
