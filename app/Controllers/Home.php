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
}
