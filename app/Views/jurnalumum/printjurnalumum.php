<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .text-left {
      text-align: left;
    }

    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    .text-specific {
      font-style: italic;
      word-spacing: 90px;
    }

    .heading {
      font-style: italic;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <p class="heading">Jurnal Umum</p>
  <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
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
          <td class="text-left" width="50"><?= $transaksi->tanggal ?></td>
          <?php if ($transaksi->debit <> 0) { ?>
            <td class="text-left" width="150"><?= $transaksi->nama_akun2 ?></td>
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

  <br><br>
  <?php echo date('l, d-m-y'); ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>