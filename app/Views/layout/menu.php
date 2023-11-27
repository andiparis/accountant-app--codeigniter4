<?php if (in_groups(['user', 'admin', 'manajer', 'direktur'])) { ?>
  <li class="menu-header">Dashboard</li>
  <li><a class="nav-link" href="<?= site_url('home') ?>"><i class="fas fa-home"></i> <span>Home</span></a></li>
<?php } ?>

<?php if (in_groups(['manajer'])) { ?>
  <li><a class="nav-link" href="<?= site_url('user') ?>"><i class="fas fa-users"></i> <span>User</span></a></li>
<?php } ?>

<?php if (in_groups(['admin'])) { ?>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Kode Akun</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="<?= site_url('akun1') ?>">Akun - 1</a></li>
      <li><a class="nav-link" href="<?= site_url('akun2') ?>">Akun - 2</a></li>
    </ul>
  </li>
<?php } ?>

<?php if (in_groups(['user', 'admin', 'direktur'])) { ?>
  <li class="menu-header">Aktiviti</li>
<?php } ?>

<?php if (in_groups(['admin'])) { ?>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Transaksi</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="<?= site_url('transaksi') ?>">Transaksi Jurnal</a></li>
    </ul>
  </li>
<?php } ?>

<?php if (in_groups(['user', 'admin'])) { ?>
  <li><a class="nav-link" href="<?= site_url('jurnalumum') ?>"><i class="fas fa-calendar-alt"></i> <span>Jurnal Umum</span></a></li>
<?php } ?>

<?php if (in_groups(['admin'])) { ?>
  <li><a class="nav-link" href="<?= site_url('posting') ?>"><i class="fas fa-beer"></i> <span>Posting</span></a></li>
<?php } ?>

<?php if (in_groups(['direktur'])) { ?>
  <li><a class="nav-link" href="<?= site_url('neracasaldo') ?>"><i class="fas fa-balance-scale"></i> <span>Neraca Saldo</span></a></li>
  <li class="dropdown">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Laporan Keuangan</span></a>
    <ul class="dropdown-menu">
      <li><a class="nav-link" href="<?= site_url('labarugi') ?>">Laba Rugi</a></li>
      <li><a class="nav-link" href="<?= site_url('aruskas') ?>">Arus Kas</a></li>
    </ul>
  </li>
<?php } ?>