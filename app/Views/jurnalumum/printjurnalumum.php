<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Jurnal Umum</title>
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
  <p class="heading">Jurnal Umum</p>
  <?php if ($startDate != null && $endDate != null) { ?>
    <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
  <?php } else { ?>
    <p>Periode : -</p>
  <?php } ?>
  <br><br>

  <table border="0.1px">
    <thead>
      <tr>
        <td class="text-center" width="50">Tanggal</td>
        <td class="text-center" width="150">Keterangan</td>
        <td class="text-center" width="50">Ref</td>
        <td class="text-center">Debit</td>
        <td class="text-center">Kredit</td>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($transaksiData as $key => $transaksi) {
      ?>
        <tr>
          <td width="50"><?= $transaksi->tanggal ?></td>
          <?php if ($transaksi->debit <> 0) { ?>
            <td width="150"><?= $transaksi->nama_akun2 ?></td>
          <?php } else { ?>
            <td class="text-specific" width="150">&nbsp;&nbsp;&nbsp;&nbsp;<?= $transaksi->nama_akun2 ?></td>
          <?php } ?>
          <td class="text-center" width="50"><?= $transaksi->kode_akun2 ?></td>
          <td class="text-right"><?= number_format($transaksi->debit, 0, ',', '.') ?></td>
          <td class="text-right"><?= number_format($transaksi->kredit, 0, ',', '.') ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>