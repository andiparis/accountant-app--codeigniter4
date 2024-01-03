<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <?= $this->renderSection('title') ?>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/assets/css/custom.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url() ?>template/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block"><?= user()->fullname == null ? user()->username : user()->fullname ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <?php if (logged_in()) { ?>
                <a href="/logout" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              <?php } else { ?>
                <a href="/login" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Login
                <?php } ?>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">Akuntansi WEB</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SIA</a>
          </div>
          <ul class="sidebar-menu">

            <?= $this->include('layout/menu') ?>

          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">

        <?= $this->renderSection('content') ?>

      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2023 <div class="bullet"></div> Design By <a href="#">Adjie Satria Anggara</a>
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>template/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url() ?>template/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>template/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>template/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>template/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>template/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url() ?>template/node_modules/chart.js/dist/Chart.min.js"></script>

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="<?= base_url() ?>template/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>template/assets/js/custom.js"></script>
</body>

</html>