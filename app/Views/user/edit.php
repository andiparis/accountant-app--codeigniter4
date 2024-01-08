<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Edit User</title>
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
        <h4>Edit Data User</h4>
      </div>
      <div class="card-body p-4">
        <form action="<?= site_url('user/' . $users->id) ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="<?= $users->email ?>" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?= $users->username ?>" required>
          </div>
          <div class="form-group">
            <label for="fullname">Fullname</label>
            <input type="text" name="fullname" id="fullname" placeholder="Nama lengkap" class="form-control" value="<?= $users->fullname ?>" required>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
              <?php foreach ($roles as $key => $value) { ?>
                <option value="<?= $value->id ?>" <?= $value->id == $users->group_id ? 'selected' : null ?>><?= ucfirst($value->name) ?></option>
              <?php } ?>
            </select>
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