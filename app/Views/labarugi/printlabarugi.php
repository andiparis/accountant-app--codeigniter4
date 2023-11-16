<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Laba Rugi</title>
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
  <p class="heading">Laporan Laba Rugi</p>
  <?php if ($startDate != null && $endDate != null) { ?>
    <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
  <?php } else { ?>
    <p>Periode : -</p>
  <?php } ?>
  <br><br>

  <table border="0.1px">
    <thead>
      <tr>
        <td class="text-center" width="225px">Deskripsi</td>
        <td class="text-center" width="100px">Pendapatan</td>
        <td class="text-center" width="100px">Beban</td>
      </tr>
    </thead>

    <tbody>
      <?php
      $totalDebit = 0;
      $totalKredit = 0;
      $labaTotalDebit = 0;
      $labaTotalKredit = 0;

      foreach ($neracaLajurData as $key => $value) {
        $debit = $value->jumlah_debit;
        $kredit = $value->jumlah_kredit;
        $neraca = $debit - $kredit;

        if ($neraca >= 0) {
          $totalDebit = $neraca;
        } else {
          $totalKredit = abs($neraca);
        }

        $kodeAkun = $value->kode_akun2;
        $kode = substr($kodeAkun, 0, 1);

        if ($kode == 4) {
          $labaTotalDebit += $totalKredit;
        }

        if ($kode == 5) {
          $labaTotalKredit += $totalDebit;
        }
      ?>
        <?php if ($kode == 4) { ?>
          <tr>
            <td width="225px"><?= $value->nama_akun2 ?></td>
            <td class="text-right" width="100px"><?= number_format($totalKredit, 0, ',', '.') ?></td>
            <td class="text-right" width="100px"></td>
          </tr>
        <?php } ?>
        <?php if ($kode == 5) { ?>
          <tr>
            <td width="225px">&nbsp;&nbsp;&nbsp;&nbsp;<?= $value->nama_akun2 ?></td>
            <td class="text-right" width="100px"></td>
            <td class="text-right" width="100px"><?= number_format($totalDebit, 0, ',', '.') ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
    </tbody>

    <tfoot>
      <tr>
        <td rowspan="2"></td>
        <td class="text-right text-specific"><?= number_format($labaTotalDebit, 0, ',', '.') ?></td>
        <td class="text-right text-specific"><?= number_format($labaTotalKredit, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td class="text-right">Laba Rugi</td>
        <td class="text-right text-specific"><?= number_format($labaTotalDebit - $labaTotalKredit, 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>