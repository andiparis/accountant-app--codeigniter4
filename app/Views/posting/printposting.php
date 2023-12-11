<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Buku Besar</title>
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
  <p class="heading">Buku Besar</p>
  <?php if ($startDate != null && $endDate != null) { ?>
    <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
  <?php } else { ?>
    <p>Periode : -</p>
  <?php } ?>
  <br><br>

  <table border="0.1px">
    <thead>
      <tr>
        <th class="text-center" rowspan="2" width="50">Tanggal</th>
        <th class="text-center" rowspan="2" width="50">Keterangan</th>
        <th class="text-center" rowspan="2" width="150">Ref</th>
        <th class="text-center" rowspan="2" width="50">Debit</th>
        <th class="text-center" rowspan="2" width="50">Kredit</th>
        <th class="text-center" colspan="2" width="100">Saldo</th>
      </tr>
      <tr>
        <td class="text-center" width="50">Debit</td>
        <td class="text-center" width="50">Kredit</td>
      </tr>
    </thead>
    <tbody>
      <?php
      $debit = 0;
      foreach ($transaksiData as $key => $transaksi) {
        if ($transaksi->debit) {
          $debit += $transaksi->debit;
        } else {
          $debit -= $transaksi->kredit;
        }

        $neracaDebit1 = $debit >= 0 ? $debit : 0;
        $neracaDebit2 = $debit < 0 ? $debit : 0;
      ?>
        <tr>
          <td width="50"><?= $transaksi->tanggal ?></td>
          <td class="text-center" width="50"><?= $transaksi->kode_akun2 ?></td>
          <td width="150"><?= $transaksi->ketjurnal ?></td>
          <td class="text-right" width="50"><?= number_format($transaksi->debit, 0, ',', '.') ?></td>
          <td class="text-right" width="50"><?= number_format($transaksi->kredit, 0, ',', '.') ?></td>
          <td class="text-right" width="50"><?= number_format($neracaDebit1, 0, ',', '.') ?></td>
          <td class="text-right" width="50"><?= number_format(abs($neracaDebit2), 0, ',', '.') ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>