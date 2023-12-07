<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Arus Kas</title>
  <style>
    .text-right {
      text-align: right;
    }

    .heading {
      font-style: italic;
      font-size: 20px;
    }
  </style>
</head>

<body>
  <p class="heading">Laporan Arus Kas</p>
  <?php if ($startDate != null && $endDate != null) { ?>
    <p>Periode : <?= date('d F Y', strtotime($startDate)) . ' s/d ' . date('d F Y', strtotime($endDate)) ?></p>
  <?php } else { ?>
    <p>Periode : -</p>
  <?php } ?>
  <br><br>

  <table border="0.1px">
    <!-- Penerimaan -->
    <tr>
      <td width="275px">Arus Kas dari Aktivitas Usaha</td>
      <td width="100px"></td>
    </tr>
    <?php
    $totpenerimaan = 0;
    foreach ($arusKasData as $key => $value) {
      if ($value->id_status == 1) {
        $penerimaan = $value->debit;
        $totpenerimaan += $penerimaan;
      }
    }
    ?>
    <tr>
      <td style="padding-left: 3em; font-style: italic;">Penerimaan Kas dari Pelanggan</td>
      <td class="text-right"><?= number_format($totpenerimaan, 0, ',', '.') ?></td>
    </tr>
    <!-- Pengeluaran -->
    <tr>
      <td>Pengeluaran Kas</td>
      <td></td>
    </tr>
    <?php
    $totpengeluaran = 0;
    foreach ($arusKasData as $key => $value) {
      if ($value->id_status == 2) {
        $pengeluaran = $value->kredit;
        $totpengeluaran += $pengeluaran;
    ?>
        <tr>
          <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
          <td class="text-right" style="padding-right: 6em;"><?= number_format($totpengeluaran, 0, ',', '.') ?></td>
        </tr>
    <?php
      }
    }
    ?>
    <tr>
      <td>Jumlah Pengeluaran</td>
      <td class="text-right"><?= number_format($totpengeluaran, 0, ',', '.') ?></td>
    </tr>
    <tr style="font-weight: bold;">
      <td>Arus Kas Bersih dari Aktivitas Usaha</td>
      <td class="text-right"><?= number_format($totpenerimaan - $totpengeluaran, 0, ',', '.') ?></td>
    </tr>

    <tr>
      <td></td>
      <td></td>
    </tr>

    <!-- Modal -->
    <tr>
      <td>Modal Masuk</td>
      <td></td>
    </tr>
    <?php
    $modal = 0;
    foreach ($arusKasData as $key => $value) {
      if ($value->id_status == 3) {
        $setor = $value->debit;
        $modal += $setor;
    ?>
        <tr>
          <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
          <td class="text-right" style="padding-right: 6em;"><?= number_format($modal, 0, ',', '.') ?></td>
        </tr>
    <?php
      }
    }
    ?>
    <!-- Prive -->
    <tr>
      <td>Modal Keluar</td>
      <td></td>
    </tr>
    <?php
    $tprive = 0;
    foreach ($arusKasData as $key => $value) {
      if ($value->id_status == 4) {
        $prive = $value->kredit;
        $tprive += $prive;
    ?>
        <tr>
          <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
          <td class="text-right" style="padding-right: 6em;"><?= number_format($tprive, 0, ',', '.') ?></td>
        </tr>
    <?php
      }
    }
    ?>
    <tr style="font-weight: bold;">
      <td>Arus Kas Bersih dari Aktivitas Investasi</td>
      <td class="text-right"><?= number_format($modal - $tprive, 0, ',', '.') ?></td>
    </tr>

    <tr>
      <td></td>
      <td></td>
    </tr>

    <tr style="font-weight: bold;">
      <td>Saldo Kas Akhir Periode</td>
      <td class="text-right"><?= number_format(($totpenerimaan - $totpengeluaran) + ($modal - $tprive), 0, ',', '.') ?></td>
    </tr>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>