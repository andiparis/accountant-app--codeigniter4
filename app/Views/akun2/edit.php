<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Edit Akun 2</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('akun2') ?>" class="btn btn-primary">Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Edit Data Akun 2</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('akun2/' . $akun2Data->id_akun2) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label for="id_akun1">Nama Akun 1</label>
            <select name="id_akun1" id="id_akun1" class="form-control" required>
              <option value="">- Pilih nama akun 1 -</option>
              <?php foreach ($akun1Data as $key => $akun1) { ?>
                <option value="<?= $akun1->id_akun1 ?>" <?= $akun1->id_akun1 == $akun2Data->id_akun1 ? 'selected' : null ?>><?= $akun1->nama_akun1 ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kode_akun2">Kode Akun 2</label>
            <input type="text" name="kode_akun2" id="kode_akun2" placeholder="Kode akun 2" class="form-control" value="<?= $akun2Data->kode_akun2 ?>" required>
          </div>
          <div class="form-group">
            <label for="nama_akun2">Nama Akun 2</label>
            <input type="text" name="nama_akun2" id="nama_akun2" placeholder="Nama akun 2" class="form-control" value="<?= $akun2Data->nama_akun2 ?>" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>