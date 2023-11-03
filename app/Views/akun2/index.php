<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Akun 2</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <a href="<?= site_url('akun2/new') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
        <h4>Data Akun 2</h4>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped table-md">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th>Nama Akun 1</th>
                <th>Kode Akun 2</th>
                <th>Nama Akun 2</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($akun2Data as $key => $akun2) {
              ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $akun2->nama_akun1 ?></td>
                  <td><?= $akun2->kode_akun2 ?></td>
                  <td><?= $akun2->nama_akun2 ?></td>
                  <td class="text-center">
                    <a href="<?= site_url('akun2/' . $akun2->id_akun2 . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form action="<?= site_url('akun2/' . $akun2->id_akun2) ?>" method="post" id="delete-<?= $akun2->id_akun2 ?>" class="d-inline">
                      <?= csrf_field() ?>
                      <input type="hidden" name="_method" value="DELETE">
                      <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun 1 ini?" data-confirm-yes="deleteData(<?= $akun2->id_akun2 ?>)"><i class="fas fa-trash"></i> Delete</button>
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