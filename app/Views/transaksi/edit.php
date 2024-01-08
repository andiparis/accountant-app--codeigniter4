<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Edit Transaksi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('transaksi') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
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
      <div class="card-header">
        <h4>Edit Data Transaksi</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('transaksi/' . $transaksiData->id_transaksi . '/edit') ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal" class="form-control" value="<?= $transaksiData->tanggal ?>" required>
          </div>
          <div class="form-group">
            <label for="ketjurnal">Keterangan Jurnal</label>
            <input type="text" name="ketjurnal" id="ketjurnal" placeholder="Keterangan Jurnal" class="form-control" value="<?= $transaksiData->ketjurnal ?>" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" class="form-control" value="<?= $transaksiData->deskripsi ?>" required>
          </div>

          <div class="box-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Akun</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $i = 0;
                foreach ($nilaiData as $item) {
                ?>
                  <tr>
                    <input type="hidden" name="id_nilai[]" value="<?= $item->id_nilai ?>" required>
                    <td><?= ++$i ?></td>
                    <td>
                      <select name="id_akun2[]" class="form-control">
                        <?php foreach ($akun2Data as $key => $akun2) { ?>
                          <option value="<?= $akun2->id_akun2 ?>" <?= $item->id_akun2 == $akun2->id_akun2 ? 'selected' : null ?>><?= $akun2->kode_akun2 ?> | <?= $akun2->nama_akun2 ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
                      <input type="text" name="debit[]" class="form-control" value="<?= $item->debit ?>" required>
                    </td>
                    <td>
                      <input type="text" name="kredit[]" class="form-control" value="<?= $item->kredit ?>" required>
                    </td>
                    <td>
                      <select name="id_status[]" class="form-control">
                        <?php foreach ($statusData as $key => $status) { ?>
                          <option value="<?= $status->id_status ?>" <?= $item->id_status == $status->id_status ? 'selected' : null ?>><?= $status->status ?></option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo-alt"></i> Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>