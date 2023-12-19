<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Add Akun</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('akun2') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Tambah Data Akun</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('akun2') ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="status_akun">Status Akun</label>
            <select name="status_akun" id="status_akun" class="form-control" required>
              <option value="1" selected>Parent</option>
              <option value="2">Child</option>
            </select>
          </div>
          <div id="accountType" class="form-group">
            <label for="jenis_akun">Jenis Akun</label>
            <select name="jenis_akun" id="jenis_akun" class="form-control" required>
              <option value="1" selected>Aktiva</option>
              <option value="2">Hutang</option>
              <option value="3">Modal</option>
              <option value="4">Pendapatan</option>
              <option value="5">Beban</option>
            </select>
          </div>
          <div id="parentAccountName" class="form-group">
            <label for="id_akun_parent">Nama Akun Parent</label>
            <select name="id_akun_parent" id="id_akun_parent" class="form-control" required>
              <?php foreach ($akun1Data as $key => $akun1) { ?>
                <option value="<?= $akun1->id_akun1 ?>"><?= $akun1->nama_akun1 ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="kode_akun">Kode Akun</label>
            <input type="text" name="kode_akun" id="kode_akun" placeholder="Kode akun" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nama_akun">Nama Akun</label>
            <input type="text" name="nama_akun" id="nama_akun" placeholder="Nama akun" class="form-control" required>
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