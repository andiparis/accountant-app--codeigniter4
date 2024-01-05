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
    $currentYear = date('Y');
    $currentMonth = date('m');

    if ($currentMonth <= 6) {
      $startMonth = 1;
      $endMonth = 6;
    } else {
      $startMonth = 7;
      $endMonth = 12;
    }

    for ($month = $startMonth; $month <= $endMonth; $month++) {
      $startDate = "$currentYear-$month-01";
      $endDate = "$currentYear-$month-" . date('t', strtotime("$currentYear-$month-01"));
      if ($startMonth <= 6) {
        $cashFlowTransaction[$month - 1] = $this->objTransaksi->getArusKas($startDate, $endDate);
      } else {
        $cashFlowTransaction[$month - 7] = $this->objTransaksi->getArusKas($startDate, $endDate);
      }
    }

    $cashFlow = [];
    for ($i = 0; $i < count($cashFlowTransaction); $i++) {

      if ($cashFlowTransaction[$i] != null) {
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
      } else {
        $cashFlow[$i] = 0;
      }
    }

    header('Content-Type: application/json');
    echo json_encode($cashFlow);
    exit;
  }
}
