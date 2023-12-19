<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Akun</title>
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
        <h4>Data Akun</h4>
      </div>
      <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="aktiva-tab" data-toggle="tab" href="#aktiva" role="tab" aria-controls="aktiva" aria-selected="true">Aktiva</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="hutang-tab" data-toggle="tab" href="#hutang" role="tab" aria-controls="hutang" aria-selected="false">Hutang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="modal-tab" data-toggle="tab" href="#modal" role="tab" aria-controls="modal" aria-selected="false">Modal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pendapatan-tab" data-toggle="tab" href="#pendapatan" role="tab" aria-controls="pendapatan" aria-selected="false">Pendapatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="beban-tab" data-toggle="tab" href="#beban" role="tab" aria-controls="beban" aria-selected="false">Beban</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="aktiva" role="tabpanel" aria-labelledby="aktiva-tab">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Kode Akun</th>
                  <th>Nama Akun</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $aktiva = $akun[0];
                foreach ($aktiva as $key => $value) {
                  $style = '';
                  $accountType = '';

                  if ($value->jenis_akun === null) {
                    $style = 'text-indent: 1rem;';
                    $accountType = 2;
                  } else {
                    $style = 'font-weight: bold;';
                    $accountType = 1;
                  }

                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="<?= $style ?>"><?= $value->kode_akun ?></td>
                    <td style="<?= $style ?>"><?= $value->nama_akun ?></td>
                    <td class="text-center">
                      <a href="<?= site_url('akun2/' . $accountType . '/' . $value->kode_akun . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <?php if ($value->jenis_akun === null) { ?>
                        <form action="<?= site_url('akun2/' . $value->kode_akun) ?>" method="post" id="delete-<?= $value->kode_akun ?>" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun ini?" data-confirm-yes="deleteData(<?= $value->kode_akun ?>)"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="hutang" role="tabpanel" aria-labelledby="hutang-tab">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Kode Akun</th>
                  <th>Nama Akun</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $hutang = $akun[1];
                foreach ($hutang as $key => $value) {
                  $style = '';
                  $accountType = '';

                  if ($value->jenis_akun === null) {
                    $style = 'text-indent: 1rem;';
                    $accountType = 2;
                  } else {
                    $style = 'font-weight: bold;';
                    $accountType = 1;
                  }
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="<?= $style ?>"><?= $value->kode_akun ?></td>
                    <td style="<?= $style ?>"><?= $value->nama_akun ?></td>
                    <td class="text-center">
                      <a href="<?= site_url('akun2/' . $accountType . '/' . $value->kode_akun . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <?php if ($value->jenis_akun === null) { ?>
                        <form action="<?= site_url('akun2/' . $value->kode_akun) ?>" method="post" id="delete-<?= $value->kode_akun ?>" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun ini?" data-confirm-yes="deleteData(<?= $value->kode_akun ?>)"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="modal" role="tabpanel" aria-labelledby="modal-tab">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Kode Akun</th>
                  <th>Nama Akun</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $modal = $akun[2];
                foreach ($modal as $key => $value) {
                  $style = '';
                  $accountType = '';

                  if ($value->jenis_akun === null) {
                    $style = 'text-indent: 1rem;';
                    $accountType = 2;
                  } else {
                    $style = 'font-weight: bold;';
                    $accountType = 1;
                  }
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="<?= $style ?>"><?= $value->kode_akun ?></td>
                    <td style="<?= $style ?>"><?= $value->nama_akun ?></td>
                    <td class="text-center">
                      <a href="<?= site_url('akun2/' . $accountType . '/' . $value->kode_akun . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <?php if ($value->jenis_akun === null) { ?>
                        <form action="<?= site_url('akun2/' . $value->kode_akun) ?>" method="post" id="delete-<?= $value->kode_akun ?>" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun ini?" data-confirm-yes="deleteData(<?= $value->kode_akun ?>)"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="pendapatan" role="tabpanel" aria-labelledby="pendapatan-tab">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Kode Akun</th>
                  <th>Nama Akun</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pendapatan = $akun[3];
                foreach ($pendapatan as $key => $value) {
                  $style = '';
                  $accountType = '';

                  if ($value->jenis_akun === null) {
                    $style = 'text-indent: 1rem;';
                    $accountType = 2;
                  } else {
                    $style = 'font-weight: bold;';
                    $accountType = 1;
                  }
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="<?= $style ?>"><?= $value->kode_akun ?></td>
                    <td style="<?= $style ?>"><?= $value->nama_akun ?></td>
                    <td class="text-center">
                      <a href="<?= site_url('akun2/' . $accountType . '/' . $value->kode_akun . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <?php if ($value->jenis_akun === null) { ?>
                        <form action="<?= site_url('akun2/' . $value->kode_akun) ?>" method="post" id="delete-<?= $value->kode_akun ?>" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun ini?" data-confirm-yes="deleteData(<?= $value->kode_akun ?>)"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="tab-pane fade" id="beban" role="tabpanel" aria-labelledby="beban-tab">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Kode Akun</th>
                  <th>Nama Akun</th>
                  <th style="width: 15%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $beban = $akun[4];
                foreach ($beban as $key => $value) {
                  $style = '';
                  $accountType = '';

                  if ($value->jenis_akun === null) {
                    $style = 'text-indent: 1rem;';
                    $accountType = 2;
                  } else {
                    $style = 'font-weight: bold;';
                    $accountType = 1;
                  }
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td style="<?= $style ?>"><?= $value->kode_akun ?></td>
                    <td style="<?= $style ?>"><?= $value->nama_akun ?></td>
                    <td class="text-center">
                      <a href="<?= site_url('akun2/' . $accountType . '/' . $value->kode_akun . '/edit') ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <?php if ($value->jenis_akun === null) { ?>
                        <form action="<?= site_url('akun2/' . $value->kode_akun) ?>" method="post" id="delete-<?= $value->kode_akun ?>" class="d-inline">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button class="btn btn-danger btn-sm" data-confirm="Konfirmasi Hapus Data | Apakah anda yakin ingin menghapus data akun ini?" data-confirm-yes="deleteData(<?= $value->kode_akun ?>)"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<?= $this->endSection() ?>