<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Neraca Saldo</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Neraca Saldo</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <form action="<?= site_url('neracasaldo') ?>" method="post">
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
              <input type="submit" class="btn btn-success" formaction="neracasaldo/printneracasaldo" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <thead class="heading">
              <tr>
                <td class="text-center" rowspan="2">Kode Akun</td>
                <td class="text-center" rowspan="2">Keterangan</td>
                <td class="text-center" colspan="2">Saldo</td>
              </tr>
              <tr>
                <td class="text-center">Debit</td>
                <td class="text-center">Kredit</td>
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
                  <td class="text-center"><?= $neracaSaldo->kode_akun2 ?></td>
                  <td><?= $neracaSaldo->nama_akun2 ?></td>
                  <td class="text-right"><?= number_format($newDebit, 0, ',', '.') ?></td>
                  <td class="text-right"><?= number_format($newKredit, 0, ',', '.') ?></td>
                </tr>
              <?php } ?>
            </tbody>

            <tfoot class="heading">
              <tr>
                <td></td>
                <td></td>
                <td class="text-right"><?= number_format($totalDebit, 0, ',', '.') ?></td>
                <td class="text-right"><?= number_format($totalKredit, 0, ',', '.') ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>