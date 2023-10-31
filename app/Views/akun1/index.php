<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Blank Page</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Data Akun 1</h4>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <thead>
              <tr>
                <th style="width: 5%">No</th>
                <th>Kode Akun 1</th>
                <th>Nama Akun</th>
                <th style="width: 15%">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($akun1Data as $key => $akun1) {
              ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><?= $akun1->kode_akun1 ?></td>
                  <td><?= $akun1->nama_akun1 ?></td>
                  <td class="text-center">
                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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