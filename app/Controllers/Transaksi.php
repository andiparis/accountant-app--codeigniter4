<?php

namespace App\Controllers;

use App\Models\ModelAkun2;
use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelTransaksi;
use CodeIgniter\RESTful\ResourceController;

/**
 * @property db $db
 * @property objTransaksi $objTransaksi
 * @property objNilai $objNilai
 */

class Transaksi extends ResourceController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objTransaksi = new ModelTransaksi();
    $this->objNilai = new ModelNilai();
  }

  /**
   * Return an array of resource objects, themselves in array format
   *
   * @return mixed
   */
  public function index()
  {
    $data['transaksiData'] = $this->objTransaksi->findAll();
    return view('transaksi/index', $data);
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
    return view('transaksi/new');
  }

  /**
   * Create a new resource object, from "posted" parameters
   *
   * @return mixed
   */
  public function create()
  {
    $data1 = [
      'kwitansi'    => $this->objTransaksi->generateKwitansiNumber(),
      'tanggal'     => $this->request->getVar('tanggal'),
      'deskripsi'   => $this->request->getVar('deskripsi'),
      'ketjurnal'   => $this->request->getVar('ketjurnal'),
    ];
    $this->db->table('transaksi')->insert($data1);

    $id_transaksi = $this->objTransaksi->insertID();
    $id_akun2 = $this->request->getVar('id_akun2');
    $debit = $this->request->getVar('debit');
    $kredit = $this->request->getVar('kredit');
    $id_status = $this->request->getVar('id_status');

    for ($i = 0; $i < count($id_akun2); $i++) {
      $data2[] = [
        'id_transaksi'  => $id_transaksi,
        'id_akun2'      => $id_akun2[$i],
        'debit'         => $debit[$i],
        'kredit'        => $kredit[$i],
        'id_status'     => $id_status[$i],
      ];
    }
    $this->objNilai->insertBatch($data2);

    return redirect()->to(site_url('transaksi'))->with('success', 'Data berhasil di simpan');
  }

  /**
   * Return the editable properties of a resource object
   *
   * @return mixed
   */
  public function edit($id = null)
  {
    //
  }

  /**
   * Add or update a model resource, from "posted" properties
   *
   * @return mixed
   */
  public function update($id = null)
  {
    //
  }

  /**
   * Delete the designated resource object from the model
   *
   * @return mixed
   */
  public function delete($id = null)
  {
    $this->objTransaksi->where(['id_transaksi' => $id])->delete();
    return redirect()->to(site_url('transaksi'))->with('success', 'Data berhasil di hapus');
  }

  public function akun2()
  {
    $akun2 = model(ModelAkun2::class);
    $result = $akun2->findAll();
    return $this->response->setJSON($result);
  }

  public function status()
  {
    $status = model(ModelStatus::class);
    $result = $status->findAll();
    return $this->response->setJSON($result);
  }
}
