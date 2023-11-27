<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAkun2;
use App\Models\ModelTransaksi;
use TCPDF;

/**
 * @property objTransaksi $objTransaksi
 * @property objAkun2 $objAkun2
 */

class Posting extends BaseController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objTransaksi = new ModelTransaksi();
    $this->objAkun2 = new ModelAkun2();
  }

  public function index()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';
    $akun2Id = $this->request->getVar('akun2_id') ? $this->request->getVar('akun2_id') : '';

    $postingData = $this->objTransaksi->getPosting($startDate, $endDate, $akun2Id);
    $data['transaksiData'] = $postingData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
    $data['akun2Id'] = $akun2Id;
    $data['akun2Data'] = $this->objAkun2->getAkun2WithAkun1();

    return view('posting/index', $data);
  }

  public function printposting()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';
    $akun2Id = $this->request->getVar('akun2_id') ? $this->request->getVar('akun2_id') : '';

    $postingData = $this->objTransaksi->getPosting($startDate, $endDate, $akun2Id);
    $data['transaksiData'] = $postingData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
    $data['akun2Id'] = $akun2Id;
    $data['akun2Data'] = $this->objAkun2->getAkun2WithAkun1();

    $html = view('posting/printposting', $data);
    $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(30, 3, 3);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $this->response->setContentType('application/pdf');
    $pdf->Output('posting.pdf', 'I');
  }
}
