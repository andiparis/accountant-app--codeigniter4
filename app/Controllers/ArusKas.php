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
 */

class ArusKas extends BaseController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objTransaksi = new ModelTransaksi();
  }

  public function index()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';

    $neracaLajurData = $this->objTransaksi->getNeracaLajur($startDate, $endDate);
    $data['neracaLajurData'] = $neracaLajurData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;

    return view('aruskas/index', $data);
  }

  public function printaruskas()
  {
    $startDate = $this->request->getVar('start_date') ? $this->request->getVar('start_date') : '';
    $endDate = $this->request->getVar('end_date') ? $this->request->getVar('end_date') : '';

    $neracaLajurData = $this->objTransaksi->getNeracaLajur($startDate, $endDate);
    $data['neracaLajurData'] = $neracaLajurData;
    $data['startDate'] = $startDate;
    $data['endDate'] = $endDate;

    $html = view('aruskas/printaruskas', $data);
    $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(30, 3, 3);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, true, false, '');
    $this->response->setContentType('application/pdf');
    $pdf->Output('aruskas.pdf', 'I');
  }
}
