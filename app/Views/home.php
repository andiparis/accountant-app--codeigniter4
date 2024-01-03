<?= $this->extend('layout/backend') ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-fire"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Jumlah Akun</h4>
          </div>
          <div class="card-body">
            <?= $totalAccount ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Jumlah Transaksi</h4>
          </div>
          <div class="card-body">
            <?= $totalTransaction ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Jumlah User</h4>
          </div>
          <div class="card-body">
            <?= $totalUser ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section-body">

  </div>
</section>

<?= $this->endSection() ?>