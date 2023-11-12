<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Add Transaksi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('transaksi') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Tambah Data Transaksi</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('transaksi') ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="kwitansi">Kwitansi</label>
            <input type="text" name="kwitansi" id="kwitansi" placeholder="Kwitansi" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="ketjurnal">Keterangan Jurnal</label>
            <input type="text" name="ketjurnal" id="ketjurnal" placeholder="Keterangan Jurnal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" required>
          </div>

          <div class="box-body">
            <table id="tableLoop" class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Akun</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Status</th>
                  <th>
                    <button id="newRow" class="btn btn-primary btn-sm btn-block"><i class="fa fa-plus"></i> Add Row</button>
                  </th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Save</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo-alt"></i> Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>