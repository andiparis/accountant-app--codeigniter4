<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Edit Akun 1</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('akun1') ?>" class="btn btn-primary">Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Edit Data Akun 1</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('akun1/edit/' . $akun1Data->id_akun1) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label for="kode_akun1">Kode Akun 1</label>
            <input type="text" name="kode_akun1" id="kode_akun1" placeholder="Kode akun 1" class="form-control" value="<?= $akun1Data->kode_akun1 ?>" required>
          </div>
          <div class="form-group">
            <label for="nama_akun1">Nama Akun 1</label>
            <input type="text" name="nama_akun1" id="nama_akun1" placeholder="Nama akun 1" class="form-control" value="<?= $akun1Data->nama_akun1 ?>" required>
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