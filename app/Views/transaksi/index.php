<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Transaksi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('transaksi/new') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
  </div>

  <?php if (session()->getFlashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert"> &times; </button>
        <?= session()->getFlashdata('success') ?>
      </div>
    </div>
  <?php } ?>
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
      <div class="card-header">
        <h4>Data Transaksi</h4>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-md">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th>Kwitansi</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Deskripsi</th>
                <th style="width: 20%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($transaksiData as $key => $transaksi) {
              ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $transaksi->kwitansi ?></td>
                  <td><?= $transaksi->tanggal ?></td>
                  <td><?= $transaksi->ketjurnal ?></td>
                  <td><?= $transaksi->deskripsi ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('transaksi/' . $transaksi->id_transaksi) ?>" class="btn btn-info btn-sm"><i class="fas fa-bars"></i> Detail</a>
                    <a href="<?= site_url('transaksi/' . $transaksi->id_transaksi . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form action="<?= site_url('transaksi/' . $transaksi->id_transaksi) ?>" method="post" id="delete-<?= $transaksi->id_transaksi ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun 1 ini?" data-confirm-yes="deleteData(<?= $transaksi->id_transaksi ?>)"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                  </td>
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