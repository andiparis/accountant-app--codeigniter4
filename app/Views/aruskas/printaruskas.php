<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Arus Kas</title>
  <style>
    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    .text-specific {
      font-style: italic;
      font-weight: bold;
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
    <tr>
      <td class="text-center" width="200px"><b>Deskripsi</b></td>
      <td class="text-center" width="100px"><b>Sub Total</b></td>
      <td class="text-center" width="100px"><b>Total</b></td>
    </tr>

    <tr class="text-specific">
      <td colspan="3">Aktivitas Operasional</td>
    </tr>
    <?php
    $totalOperating = 0;

    foreach ($neracaLajurData as $key => $value) {
      $debit = $value->jumlah_debit;
      $kredit = $value->jumlah_kredit;
      $neraca = $debit - $kredit;

      $kodeAkun = $value->kode_akun2;
      $kode1 = substr($kodeAkun, 0, 1);
      $kode2 = substr($kodeAkun, 0, 2);

      if ($kode2 == 11 && $neraca > 0) {
        $totalOperating += $neraca;
      }
      if ($kode1 == 4) {
        $neraca = abs($neraca);
        $totalOperating += $neraca;
      }
      if ($kode1 == 5) {
        $totalOperating -= $neraca;
      }
    ?>
      <?php if (($kode2 == 11 && $neraca > 0) || $kode1 == 4 || $kode1 == 5) { ?>
        <tr>
          <td width="200px"><?= $value->nama_akun2 ?></td>
          <td class="text-right" width="100px"><?= number_format($neraca, 0, ',', '.') ?></td>
          <td width="100px"></td>
        </tr>
      <?php } ?>
    <?php } ?>
    <tr class="text-specific">
      <td class="text-right" colspan="2">Total</td>
      <td class="text-right"><?= number_format($totalOperating, 0, ',', '.') ?></td>
    </tr>

    <tr class="text-specific">
      <td colspan="3">Aktivitas Investasi</td>
    </tr>
    <?php
    $totalInvesting = 0;

    foreach ($neracaLajurData as $key => $value) {
      $debit = $value->jumlah_debit;
      $kredit = $value->jumlah_kredit;
      $neraca = $debit - $kredit;

      $kodeAkun = $value->kode_akun2;
      $kode2 = substr($kodeAkun, 0, 2);

      if ($kode2 == 12) {
        $totalInvesting += $neraca;
      }
    ?>
      <?php if ($kode2 == 12) { ?>
        <tr>
          <td width="200px"><?= $value->nama_akun2 ?></td>
          <td class="text-right" width="100px"><?= number_format($neraca, 0, ',', '.') ?></td>
          <td width="100px"></td>
        </tr>
      <?php } ?>
    <?php } ?>
    <tr class="text-specific">
      <td class="text-right" colspan="2">Total</td>
      <td class="text-right"><?= number_format($totalInvesting, 0, ',', '.') ?></td>
    </tr>

    <tr class="text-specific">
      <td colspan="3">Aktivitas Pendanaan</td>
    </tr>
    <?php
    $totalFinancing = 0;

    foreach ($neracaLajurData as $key => $value) {
      $debit = $value->jumlah_debit;
      $kredit = $value->jumlah_kredit;
      $neraca = $debit - $kredit;

      $kodeAkun = $value->kode_akun2;
      $kode2 = substr($kodeAkun, 0, 2);

      if ($kode2 == 31) {
        $neraca = abs($neraca);
        $totalFinancing += $neraca;
      }
      if ($kode2 == 32) {
        $totalFinancing -= $neraca;
      }
    ?>
      <?php if ($kode2 == 31 || $kode2 == 32) { ?>
        <tr>
          <td width="200px"><?= $value->nama_akun2 ?></td>
          <td class="text-right" width="100px"><?= number_format($neraca, 0, ',', '.') ?></td>
          <td width="100px"></td>
        </tr>
      <?php } ?>
    <?php } ?>
    <tr class="text-specific">
      <td class="text-right" colspan="2">Total</td>
      <td class="text-right"><?= number_format($totalFinancing, 0, ',', '.') ?></td>
    </tr>

    <tr class="text-specific">
      <td class="text-right" colspan="2">Arus Kas</td>
      <td class="text-right"><?= number_format($totalOperating + $totalInvesting + $totalFinancing, 0, ',', '.') ?></td>
    </tr>
  </table>

  <?php echo '<p>' . date('l, d F Y') . '</p>' ?>
  <br>
  <p>Store Manajer _____________</p>
</body>

</html>