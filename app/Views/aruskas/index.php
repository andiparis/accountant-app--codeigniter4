<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Arus Kas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Arus Kas</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <form action="<?= site_url('aruskas') ?>" method="post">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col">
              <input type="date" name="start_date" class="form-control" value="<?= $startDate ?>">
            </div>
            <div class="col">
              <input type="date" name="end_date" class="form-control" value="<?= $endDate ?>">
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i> Tampilkan</button>
              <input type="submit" class="btn btn-success" formaction="aruskas/printaruskas" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="heading" style="background-color: darkorchid;">
              <td class="text-center">Deskripsi</td>
              <td class="text-center" width="200px">Sub Total</td>
              <td class="text-center" width="200px">Total</td>
            </tr>

            <tr>
              <td colspan="3"><b>AKTIVITAS OPERASIONAL</b></td>
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
                  <td><?= $value->nama_akun2 ?></td>
                  <td class="text-right" width="200px"><?= number_format($neraca, 0, ',', '.') ?></td>
                  <td width="200px"></td>
                </tr>
              <?php } ?>
            <?php } ?>
            <tr class="heading2" style="background-color: darkmagenta;">
              <td></td>
              <td class="text-right">Total</td>
              <td class="text-right"><?= number_format($totalOperating, 0, ',', '.') ?></td>
            </tr>

            <tr>
              <td colspan="3"><b>AKTIVITAS INVESTASI</b></td>
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
                  <td><?= $value->nama_akun2 ?></td>
                  <td class="text-right" width="200px"><?= number_format($neraca, 0, ',', '.') ?></td>
                  <td width="200px"></td>
                </tr>
              <?php } ?>
            <?php } ?>
            <tr class="heading2" style="background-color: darkmagenta;">
              <td></td>
              <td class="text-right">Total</td>
              <td class="text-right"><?= number_format($totalInvesting, 0, ',', '.') ?></td>
            </tr>

            <tr>
              <td colspan="3"><b>AKTIVITAS PENDANAAN</b></td>
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
                  <td><?= $value->nama_akun2 ?></td>
                  <td class="text-right" width="200px"><?= number_format($neraca, 0, ',', '.') ?></td>
                  <td width="200px"></td>
                </tr>
              <?php } ?>
            <?php } ?>
            <tr class="heading2" style="background-color: darkmagenta;">
              <td></td>
              <td class="text-right">Total</td>
              <td class="text-right"><?= number_format($totalFinancing, 0, ',', '.') ?></td>
            </tr>

            <tr class="heading2" style="background-color: purple;">
              <td></td>
              <td class="text-right">Arus Kas</td>
              <td class="text-right"><?= number_format($totalOperating + $totalInvesting + $totalFinancing, 0, ',', '.') ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>