<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; User</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('user/new') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
  </div>

  <?php

  use Kint\Zval\Value;

  if (session()->getFlashdata('success')) { ?>
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
        <h4>Data User</h4>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-md">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th>Email</th>
                <th>Username</th>
                <th>Fullname</th>
                <th>Role</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($users as $key => $value) {
              ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $value->email ?></td>
                  <td><?= $value->username ?></td>
                  <td><?= $value->fullname == null ? '-' : $value->fullname ?></td>
                  <td><?= ucfirst($value->role) ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('user/' . $value->id . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form action="<?= site_url('user/' . $value->id) ?>" method="post" id="delete-<?= $value->id ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data user ini?" data-confirm-yes="deleteData(<?= $value->id ?>)"><i class="fas fa-trash"></i> Delete</button>
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