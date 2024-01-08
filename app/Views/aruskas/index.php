<?= $this->extend('layout/backend') ?>

<?= $this->section('title') ?>
<title>SIA &mdash; Arus Kas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-header">
    <h1>Arus Kas</h1>
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
      <div class="card-body">
        <form action="<?= site_url('aruskas') ?>" method="post">
          <?= csrf_field() ?>
          <div class="row">
            <div class="col">
              <input type="date" name="start_date" class="form-control" value="<?= $startDate ?>">
            </div>
            <div class="col">
              <input type="date" name="end_date" class="form-control" value="<?= $endDate ?>">
            </div>
            <div class="col">
              <button type="submit" class="btn btn-primary"><i class="fas fa-list"></i> Tampilkan</button>
              <input type="submit" class="btn btn-success" formaction="aruskas/printaruskas" formtarget="_blank" value="Cetak PDF">
            </div>
          </div>
        </form>
      </div>
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-hover table-striped table-md">
            <!-- Penerimaan -->
            <tr>
              <td>Arus Kas dari Aktivitas Usaha</td>
              <td></td>
            </tr>
            <?php
            $totpenerimaan = 0;
            foreach ($arusKasData as $key => $value) {
              if ($value->id_status == 1) {
                $penerimaan = $value->debit;
                $totpenerimaan += $penerimaan;
              }
            }
            ?>
            <tr>
              <td style="padding-left: 3em; font-style: italic;">Penerimaan Kas dari Pelanggan</td>
              <td class="text-right"><?= number_format($totpenerimaan, 0, ',', '.') ?></td>
            </tr>
            <!-- Pengeluaran -->
            <tr>
              <td>Pengeluaran Kas</td>
              <td></td>
            </tr>
            <?php
            $totpengeluaran = 0;
            foreach ($arusKasData as $key => $value) {
              if ($value->id_status == 2) {
                $pengeluaran = $value->kredit;
                $totpengeluaran += $pengeluaran;
            ?>
                <tr>
                  <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
                  <td class="text-right" style="padding-right: 6em;"><?= number_format($totpengeluaran, 0, ',', '.') ?></td>
                </tr>
            <?php
              }
            }
            ?>
            <tr>
              <td>Jumlah Pengeluaran</td>
              <td class="text-right"><?= number_format($totpengeluaran, 0, ',', '.') ?></td>
            </tr>
            <tr style="font-weight: bold;">
              <td>Arus Kas Bersih dari Aktivitas Usaha</td>
              <td class="text-right"><?= number_format($totpenerimaan - $totpengeluaran, 0, ',', '.') ?></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
            </tr>

            <!-- Modal -->
            <tr>
              <td>Modal Masuk</td>
              <td></td>
            </tr>
            <?php
            $modal = 0;
            foreach ($arusKasData as $key => $value) {
              if ($value->id_status == 3) {
                $setor = $value->debit;
                $modal += $setor;
            ?>
                <tr>
                  <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
                  <td class="text-right" style="padding-right: 6em;"><?= number_format($modal, 0, ',', '.') ?></td>
                </tr>
            <?php
              }
            }
            ?>
            <!-- Prive -->
            <tr>
              <td>Modal Keluar</td>
              <td></td>
            </tr>
            <?php
            $tprive = 0;
            foreach ($arusKasData as $key => $value) {
              if ($value->id_status == 4) {
                $prive = $value->kredit;
                $tprive += $prive;
            ?>
                <tr>
                  <td style="padding-left: 3em; font-style: italic;"><?= $value->ketjurnal ?></td>
                  <td class="text-right" style="padding-right: 6em;"><?= number_format($tprive, 0, ',', '.') ?></td>
                </tr>
            <?php
              }
            }
            ?>
            <tr style="font-weight: bold;">
              <td>Arus Kas Bersih dari Aktivitas Investasi</td>
              <td class="text-right"><?= number_format($modal - $tprive, 0, ',', '.') ?></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
            </tr>

            <tr style="font-weight: bold;">
              <td>Saldo Kas Akhir Periode</td>
              <td class="text-right"><?= number_format(($totpenerimaan - $totpengeluaran) + ($modal - $tprive), 0, ',', '.') ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>