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
    $accountType = [1, 2, 3, 4, 5];

    $data = [
      'akun'        => $this->objAkun2->getAkun($accountType),
    ];

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
    $data = [
      'akun1Data'   => $this->objAkun2->getAkun1(),
      'loc'         => 'account-form'
    ];

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

    $statusAkun = $this->request->getVar('status_akun');

    if ($statusAkun === '1') {
      $data = [
        'kode_akun1'  => $this->request->getVar('kode_akun'),
        'nama_akun1'  => $this->request->getVar('nama_akun'),
        'jenis_akun'  => $this->request->getVar('jenis_akun'),
      ];
      $this->db->table('akun1s')->insert($data);
    } else {
      $data = [
        'kode_akun2'  => $this->request->getVar('kode_akun'),
        'nama_akun2'  => $this->request->getVar('nama_akun'),
        'id_akun1'    => $this->request->getVar('id_akun_parent'),
      ];
      $this->db->table('akun2s')->insert($data);
    }

    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di simpan');
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return mixed
   */
  public function edit($accountType = null, $id = null)
  {
    if ($accountType == 1) {
      $table = 'akun1s';
      $tableField = 'kode_akun1';
    } else {
      $table = 'akun2s';
      $tableField = 'kode_akun2';
    }
    $akun = $this->objAkun2->getAkunById($id, $table, $tableField);

    if (is_object($akun)) {
      $data = [
        'akun1'   => $this->objAkun2->getAkun1(),
        'akun'    => $akun,
        'loc'     => 'account-form'
      ];

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
  public function update($accountType = null, $id = null)
  {
    if ($accountType === '1') {
      $data = [
        'kode_akun1'  => $this->request->getVar('kode_akun'),
        'nama_akun1'  => $this->request->getVar('nama_akun'),
        'jenis_akun'  => $this->request->getVar('jenis_akun'),
      ];
      $this->db->table('akun1s')->where(['kode_akun1' => $id])->update($data);
    } else {
      $data = [
        'kode_akun2'  => $this->request->getVar('kode_akun'),
        'nama_akun2'  => $this->request->getVar('nama_akun'),
        'id_akun1'    => $this->request->getVar('id_akun_parent'),
      ];
      $this->db->table('akun2s')->where(['kode_akun2' => $id])->update($data);
    }

    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di update');
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return mixed
   */
  public function delete($id = null)
  {
    $this->db->table('akun2s')->where(['kode_akun2' => $id])->delete();
    return redirect()->to(site_url('akun2'))->with('success', 'Data berhasil di hapus');
  }
}
