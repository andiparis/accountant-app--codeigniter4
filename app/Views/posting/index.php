<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Posting</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Posting</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-body">
        <form action="<?= site_url('posting') ?>" method="post">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col">
              <input type="date" name="start_date" class="form-control" value="<?= $startDate ?>">
            </div>
            <div class="col">
              <input type="date" name="end_date" class="form-control" value="<?= $endDate ?>">
            </div>
            <div class="col">
              <select name="akun2_id" class="form-control">
                <option value=""> - Pilih kode akun - </option>
                <?php foreach ($akun2Data as $key => $akun2) { ?>
                  <option value="<?= $akun2->id_akun2 ?>" <?= $akun2Id == $akun2->id_akun2 ? 'selected' : null ?>><?= $akun2->kode_akun2 ?> | <?= $akun2->nama_akun2 ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i> Tampilkan</button>
              <input type="submit" class="btn btn-success" formaction="posting/printposting" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <thead>
              <tr>
                <td class="text-center" rowspan="2">Tanggal</td>
                <td class="text-center" rowspan="2">Keterangan</td>
                <td class="text-center" rowspan="2">Ref</td>
                <td class="text-center" rowspan="2">Debit</td>
                <td class="text-center" rowspan="2">Kredit</td>
                <td class="text-center" colspan="2">Saldo</td>
              </tr>
              <tr>
                <td class="text-center">Debit</td>
                <td class="text-center">Kredit</td>
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
                  <td><?= $transaksi->tanggal ?></td>
                  <td class="text-center"><?= $transaksi->kode_akun2 ?></td>
                  <td><?= $transaksi->ketjurnal ?></td>
                  <td class="text-right"><?= number_format($transaksi->debit, 0, ',', '.') ?></td>
                  <td class="text-right"><?= number_format($transaksi->kredit, 0, ',', '.') ?></td>
                  <td class="text-right"><?= number_format($neracaDebit1, 0, ',', '.') ?></td>
                  <td class="text-right"><?= number_format(abs($neracaDebit2), 0, ',', '.') ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>