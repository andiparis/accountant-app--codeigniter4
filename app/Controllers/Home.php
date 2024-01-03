<?php

namespace App\Controllers;

use App\Models\ModelAkun2;
use App\Models\ModelTransaksi;
use App\Models\ModelUser;

/**
 * @property objAkun2 $objAkun2
 * @property objTransaksi $objTransaksi
 * @property objUser $objUser
 */

class Home extends BaseController
{
  function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->objAkun2 = new ModelAkun2();
    $this->objTransaksi = new ModelTransaksi();
    $this->objUser = new ModelUser();
  }

  public function index(): string
  {
    $data = [
      'totalAccount'      => $this->objAkun2->getTotalAkun2(),
      'totalTransaction'  => $this->objTransaksi->getTotalTransaksi(),
      'totalUser'         => $this->objUser->getTotalUser(),
    ];

    return view('home', $data);
  }

  public function getChartCashFlowData()
  {
    $cashFlowTransaction = [];
    $year = date('Y');
    for ($month = 1; $month <= 12; $month++) {
      $startDate = "$year-$month-01";
      $endDate = "$year-$month-" . date('t', strtotime("$year-$month-01"));
      $cashFlowTransaction[$month - 1] = $this->objTransaksi->getArusKas($startDate, $endDate);
    }

    $cashFlow = [];
    for ($i = 0; $i < count($cashFlowTransaction); $i++) {

      // Arus kas bersih dari aktivitas usaha
      $totpenerimaan = 0;
      foreach ($cashFlowTransaction[$i] as $key => $value) {
        if ($value->id_status == 1) {
          $penerimaan = $value->debit;
          $totpenerimaan += $penerimaan;
        }
      }

      $totpengeluaran = 0;
      foreach ($cashFlowTransaction[$i] as $key => $value) {
        if ($value->id_status == 2) {
          $pengeluaran = $value->kredit;
          $totpengeluaran += $pengeluaran;
        }
      }
      $operationalActivity = $totpenerimaan - $totpengeluaran;

      // Arus kas bersih dari aktivitas investasi
      $modal = 0;
      foreach ($cashFlowTransaction[$i] as $key => $value) {
        if ($value->id_status == 3) {
          $setor = $value->debit;
          $modal += $setor;
        }
      }

      $tprive = 0;
      foreach ($cashFlowTransaction[$i] as $key => $value) {
        if ($value->id_status == 4) {
          $prive = $value->kredit;
          $tprive += $prive;
        }
      }
      $investmentActivity = $modal - $tprive;

      $cashFlow[$i] = $operationalActivity + $investmentActivity;
    }

    header('Content-Type: application/json');
    echo json_encode($cashFlow);
    exit;
  }
}
