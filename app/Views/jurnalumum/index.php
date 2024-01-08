<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Jurnal Umum</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Laporan Jurnal Umum</h1>
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
        <form action="<?= site_url('jurnalumum') ?>" method="post">
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
              <input type="submit" class="btn btn-success" formaction="jurnalumum/printjurnalumum" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Ref</th>
                <th>Debit</th>
                <th>Kredit</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($transaksiData as $key => $transaksi) {
              ?>
                <tr>
                  <td><?= $transaksi->tanggal ?></td>
                  <td><?= $transaksi->nama_akun2 ?></td>
                  <td><?= $transaksi->kode_akun2 ?></td>
                  <td class="text-right"><?= number_format($transaksi->debit, 0, ',', '.') ?></td>
                  <td class="text-right"><?= number_format($transaksi->kredit, 0, ',', '.') ?></td>
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