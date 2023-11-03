<?php

namespace App\Controllers;

use App\Models\ModelAkun2;
use CodeIgniter\RESTful\ResourceController;

/**
 * @property db $db
 * @property objAkun2 $objAkun2
 */

class Akun2 extends ResourceController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objAkun2 = new ModelAkun2();
  }

  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    $data['akun2Data'] = $this->objAkun2->getAkun2WithAkun1();
    return view('akun2/index', $data);
  }

  /**
   * Return the properties of a resource object
   *
   * @return mixed
   */
  public function show($id = null)
  {
    //
  }

  /**
   * Return a new resource object, with default properties
   *
   * @return mixed
   */
  public function new()
  {
    $builder = $this->db->table('akun1s');
    $query = $builder->get();
    $data['akun1Data'] = $query->getResult();
    return view('akun2/new', $data);
  }

  /**
   * Create a new resource object, from "posted" parameters
   *
   * @return mixed
   */
  public function create()
  {
    $data = $this->request->getPost();
    $data = [
      'kode_akun2'  => $this->request->getVar('kode_akun2'),
      'nama_akun2'  => $this->request->getVar('nama_akun2'),
      'id_akun1'    => $this->request->getVar('id_akun1'),
    ];
    $this->db->table('akun2s')->insert($data);
    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di simpan');
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return mixed
   */
  public function edit($id = null)
  {
    $builder = $this->db->table('akun1s');
    $query = $builder->get();

    $akun2 = $this->objAkun2->find($id);
    if (is_object($akun2)) {
      $data['akun1Data'] = $query->getResult();
      $data['akun2Data'] = $akun2;
      return view('akun2/edit', $data);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  /**
   * Add or update a model resource, from "posted" properties
   *
   * @return mixed
   */
  public function update($id = null)
  {
    $data = [
      'kode_akun2'  => $this->request->getVar('kode_akun2'),
      'nama_akun2'  => $this->request->getVar('nama_akun2'),
      'id_akun1'    => $this->request->getVar('id_akun1'),
    ];
    $this->db->table('akun2s')->where(['id_akun2' => $id])->update($data);
    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di update');
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return mixed
   */
  public function delete($id = null)
  {
    $this->db->table('akun2s')->where(['id_akun2' => $id])->delete();
    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di hapus');
  }
}
