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
 * @property objAkun2 $objAkun2
 * @property objNilai $objNilai
 * @property objStatus $objStatus
 */

class Transaksi extends ResourceController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objTransaksi = new ModelTransaksi();
    $this->objAkun2 = new ModelAkun2();
    $this->objNilai = new ModelNilai();
    $this->objStatus = new ModelStatus();
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
    $transaksi = $this->objTransaksi->find($id);
    $akun2 = $this->objAkun2->findAll();
    $nilai = $this->objNilai->getNilaiWithAllRelationUsingId($id);
    $status = $this->objStatus->findAll();

    if (is_object($transaksi)) {
      $data['transaksiData'] = $transaksi;
      $data['akun2Data'] = $akun2;
      $data['nilaiData'] = $nilai;
      $data['statusData'] = $status;

      return view('transaksi/show', $data);
    } else {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
  }

  /**
   * Return a new resource object, with default properties
   *
   * @return mixed
   */
  public function new()
  {
    return view('transaksi/new', [
      'loc' => 'transaction-form'
    ]);
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
    $transaksi = $this->objTransaksi->find($id);
    $akun2 = $this->objAkun2->findAll();
    $nilai = $this->db->table('nilai')->where(['id_transaksi' => $id])->get()->getResult();
    $status = $this->objStatus->findAll();

    if (is_object($transaksi)) {
      $data = [
        'transaksiData' => $transaksi,
        'akun2Data'     => $akun2,
        'nilaiData'     => $nilai,
        'statusData'    => $status,
        'loc'           => 'transaction-form',
      ];

      return view('transaksi/edit', $data);
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
    $data1 = [
      'tanggal'     => $this->request->getVar('tanggal'),
      'deskripsi'   => $this->request->getVar('deskripsi'),
      'ketjurnal'   => $this->request->getVar('ketjurnal'),
    ];
    $this->db->table('transaksi')->where(['id_transaksi' => $id])->update($data1);

    $id_nilai = $this->request->getVar('id_nilai');
    $id_akun2 = $this->request->getVar('id_akun2');
    $debit = $this->request->getVar('debit');
    $kredit = $this->request->getVar('kredit');
    $id_status = $this->request->getVar('id_status');

    foreach ($id_nilai as $key => $value) {
      $data2[] = [
        'id_nilai'      => $id_nilai[$key],
        'id_akun2'      => $id_akun2[$key],
        'debit'         => $debit[$key],
        'kredit'        => $kredit[$key],
        'id_status'     => $id_status[$key],
      ];
    }
    $this->objNilai->updateBatch($data2, 'id_nilai');

    return redirect()->to(site_url('transaksi'))->with('success', 'Data berhasil di update');
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
