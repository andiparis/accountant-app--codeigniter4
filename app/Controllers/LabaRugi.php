<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAkun2;
use App\Models\ModelNilai;
use App\Models\ModelStatus;
use App\Models\ModelTransaksi;
use TCPDF;

/**
 * @property objTransaksi $objTransaksi
 * @property objAkun2 $objAkun2
 * @property objNilai $objNilai
 * @property objStatus $objStatus
 */

class LabaRugi extends BaseController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objTransaksi = new ModelTransaksi();
    $this->objAkun2 = new ModelAkun2();
    $this->objNilai = new ModelNilai();
    $this->objStatus = new ModelStatus();
  }

  public function index()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';

    $neracaLajurData = $this->objTransaksi->getNeracaLajur($startDate, $endDate);
    $data['neracaLajurData'] = $neracaLajurData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;

    return view('labarugi/index', $data);
  }

  public function printlabarugi()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';

    $neracaLajurData = $this->objTransaksi->getNeracaLajur($startDate, $endDate);
    $data['neracaLajurData'] = $neracaLajurData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;

    $html = view('labarugi/printlabarugi', $data);
    $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(30, 3, 3);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $this->response->setContentType('application/pdf');
    $pdf->Output('labarugi.pdf', 'I');
  }
}
