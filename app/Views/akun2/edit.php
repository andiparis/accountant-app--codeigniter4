<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Edit Akun</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('akun2') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Edit Data Akun</h4>
      </div>
      <div class="card-body p-4">
        <?php
        $accountStatus = null;
        $accountType = null;
        $id_akun1 = null;

        if (property_exists($akun, 'jenis_akun')) {
          $accountStatus = 1;
          $accountType = $akun->jenis_akun;
          $kode_akun = $akun->kode_akun1;
          $nama_akun = $akun->nama_akun1;
        } else {
          $accountStatus = 2;
          $id_akun1 = $akun->id_akun1;
          $kode_akun = $akun->kode_akun2;
          $nama_akun = $akun->nama_akun2;
        }
        ?>
        <form action="<?= site_url('akun2/' . $accountStatus . '/' . $kode_akun) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <?php if ($accountStatus === 1) { ?>
            <div id="accountType" class="form-group">
              <label for="jenis_akun">Jenis Akun</label>
              <select name="jenis_akun" id="jenis_akun" class="form-control" required>
                <option value="1" <?= ($accountType == 1) ? 'selected' : null ?>>Aktiva</option>
                <option value="2" <?= ($accountType == 2) ? 'selected' : null ?>>Hutang</option>
                <option value="3" <?= ($accountType == 3) ? 'selected' : null ?>>Modal</option>
                <option value="4" <?= ($accountType == 4) ? 'selected' : null ?>>Pendapatan</option>
                <option value="5" <?= ($accountType == 5) ? 'selected' : null ?>>Beban</option>
              </select>
            </div>
          <?php } else { ?>
            <div id="parentAccountName" class="form-group">
              <label for="id_akun_parent">Nama Akun Parent</label>
              <select name="id_akun_parent" id="id_akun_parent" class="form-control" required>
                <?php foreach ($akun1 as $key => $value) { ?>
                  <option value="<?= $value->id_akun1 ?>" <?= $value->id_akun1 == $id_akun1 ? 'selected' : null ?>><?= $value->nama_akun1 ?></option>
                <?php } ?>
              </select>
            </div>
          <?php } ?>
          <div class="form-group">
            <label for="kode_akun">Kode Akun</label>
            <input type="text" name="kode_akun" id="kode_akun" placeholder="Kode akun" class="form-control" value="<?= $kode_akun ?>" required>
          </div>
          <div class="form-group">
            <label for="nama_akun">Nama Akun</label>
            <input type="text" name="nama_akun" id="nama_akun" placeholder="Nama akun" class="form-control" value="<?= $nama_akun ?>" required>
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