<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Detail Transaksi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('transaksi') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Detail Transaksi</h4>
      </div>
      <div class="card-body p-4">
        <table class="table mb-4">
          <tr>
            <td>No Kwitansi</td>
            <td class="p-0">:</td>
            <td><?= $transaksiData->kwitansi ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td class="p-0">:</td>
            <td><?= $transaksiData->tanggal ?></td>
          </tr>
          <tr>
            <td>Keterangan Jurnal</td>
            <td class="p-0">:</td>
            <td><?= $transaksiData->ketjurnal ?></td>
          </tr>
          <tr>
            <td>Deskripsi</td>
            <td class="p-0">:</td>
            <td><?= $transaksiData->deskripsi ?></td>
          </tr>
        </table>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 5%">No</th>
              <th>Kode Akun</th>
              <th>Nama Akun</th>
              <th>Debit</th>
              <th>Kredit</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($nilaiData as $key => $item) { ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $item->kode_akun2 ?></td>
                <td><?= $item->nama_akun2 ?></td>
                <td class="text-right"><?= number_format($item->debit, 0, ',', '.') ?></td>
                <td class="text-right"><?= number_format($item->kredit, 0, ',', '.') ?></td>
                <td><?= $item->status ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>