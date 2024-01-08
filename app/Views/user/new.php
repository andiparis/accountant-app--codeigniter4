<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Add User</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('user') ?>" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
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
        <h4>Tambah Data User</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('user') ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" id="fullname" placeholder="Nama lengkap" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
              <option value="">- Pilih role -</option>
              <?php foreach ($roles as $key => $value) { ?>
                <option value="<?= $value->id ?>"><?= ucfirst($value->name) ?></option>
              <?php } ?>
            </select>
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