<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Neraca Saldo</title>
  <style>
    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    .text-specific {
      font-style: italic;
    }

    .heading {
      font-style: italic;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <p class="heading">Neraca Saldo</p>
  <?php if ($startDate != null && $endDate != null) { ?>
    <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
  <?php } else { ?>
    <p>Periode : -</p>
  <?php } ?>
  <br><br>

  <table border="0.1px">
    <thead>
      <tr>
        <td class="text-center" width="50" rowspan="2">Kode Akun</td>
        <td class="text-center" width="225" rowspan="2">Keterangan</td>
        <td class="text-center" width="150" colspan="2">Saldo</td>
      </tr>
      <tr>
        <td class="text-center" width="75px">Debit</td>
        <td class="text-center" width="75px">Kredit</td>
      </tr>
    </thead>

    <tbody>
      <?php
      $totalDebit = 0;
      $totalKredit = 0;
      foreach ($neracaSaldoData as $key => $neracaSaldo) {
        $debit = $neracaSaldo->jumlah_debit;
        $kredit = $neracaSaldo->jumlah_kredit;
        $neraca = $debit - $kredit;

        if ($neraca < 0) {
          $newKredit = abs($neraca);
          $totalKredit += $newKredit;
        } else {
          $newKredit = 0;
        }

        if ($neraca > 0) {
          $newDebit = $neraca;
          $totalDebit += $newDebit;
        } else {
          $newDebit = 0;
        }
      ?>
        <tr>
          <td class="text-center" width="50px"><?= $neracaSaldo->kode_akun2 ?></td>
          <td width="225px"><?= $neracaSaldo->nama_akun2 ?></td>
          <td class="text-right" width="75px"><?= number_format($newDebit, 0, ',', '.') ?></td>
          <td class="text-right" width="75px"><?= number_format($newKredit, 0, ',', '.') ?></td>
        </tr>
      <?php } ?>
    </tbody>

    <tfoot class="heading">
      <tr>
        <td colspan="2"></td>
        <td class="text-right text-specific"><?= number_format($totalDebit, 0, ',', '.') ?></td>
        <td class="text-right text-specific"><?= number_format($totalKredit, 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>