<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Laba Rugi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laba Rugi</h1>
  </div>

  <?php if (session()->getFlashdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert"> &times; </button>
        <?= session()->getFlashdata('error') ?>
      </div>
    </div>
  <?php } ?>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <form action="<?= site_url('labarugi') ?>" method="post">
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
              <input type="submit" class="btn btn-success" formaction="labarugi/printlabarugi" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <thead class="heading">
              <tr>
                <td class="text-center">Deskripsi</td>
                <td class="text-center" width="200px">Pendapatan</td>
                <td class="text-center" width="200px">Beban</td>
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
                    <td><?= $value->nama_akun2 ?></td>
                    <td class="text-right" width="200px"><?= number_format($totalKredit, 0, ',', '.') ?></td>
                    <td class="text-right" width="200px"></td>
                  </tr>
                <?php } ?>
                <?php if ($kode == 5) { ?>
                  <tr>
                    <td>&emsp;&emsp;<?= $value->nama_akun2 ?></td>
                    <td class="text-right" width="200px"></td>
                    <td class="text-right" width="200px"><?= number_format($totalDebit, 0, ',', '.') ?></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>

            <tfoot>
              <tr class="heading">
                <td></td>
                <td class="text-right"><?= number_format($labaTotalDebit, 0, ',', '.') ?></td>
                <td class="text-right"><?= number_format($labaTotalKredit, 0, ',', '.') ?></td>
              </tr>
              <tr class="heading2">
                <td></td>
                <td class="text-right">Laba Rugi</td>
                <td class="text-right"><?= number_format($labaTotalDebit - $labaTotalKredit, 0, ',', '.') ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>