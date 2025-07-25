<?= $this->extend('/admin/index'); ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<form action="<?= base_url('admin/updateTransaksi/' . $pemesanan['id_p']) ?>" method="post">
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Detail Transaksi #<?= esc($pemesanan['id_p']) ?></h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home">
            <a href="">
              <i class="icon-home"></i>
            </a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Edit Transaksi</a>
          </li>
          <li class="separator">
            <i class="icon-arrow-right"></i>
          </li>
          <li class="nav-item">
            <a href="#">Transaksi</a>
          </li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Detail Transaksi</div>
            </div>
            <div class="card-body">
              <!-- Formulir Edit Transaksi -->
              <div class="row">
                <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                    <label for="id_u">ID Pelanggan</label>
                    <input type="text" name="id_u" class="form-control" id="id_u" value="<?= esc($pemesanan['id_u']) ?>" readonly />
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= esc($pemesanan['nama']) ?>" readonly />
                  </div>
                </div>

                <!-- Kolom Detail Barang -->
                <div class="col-md-12">
                  <h5>Detail Barang</h5>
                  <?php foreach ($details as $i => $detail): ?>
                    <input type="hidden" name="detail_id[]" value="<?= $detail['id_detail'] ?>">
                    <div class="row mb-3">
                      <div class="col-md-3">
                        <label>Jenis</label>
                        <input type="text" name="jenis[]" class="form-control" value="<?= esc($detail['jenis']) ?>" required />
                      </div>
                      <div class="col-md-3">
                        <label>Model</label>
                        <input type="text" name="model[]" class="form-control" value="<?= esc($detail['model']) ?>" required />
                      </div>
                      <div class="col-md-2">
                        <label>Ukuran</label>
                        <input type="text" name="ukuran[]" class="form-control" value="<?= esc($detail['ukuran']) ?>" required />
                      </div>
                      <div class="col-md-2">
                        <label>Lengan</label>
                        <input type="text" name="lengan[]" class="form-control" value="<?= esc($detail['lengan']) ?>" required />
                      </div>
                      <div class="col-md-2">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control" value="<?= esc($detail['jumlah']) ?>" required />
                      </div>
                      <div class="col-md-2">
                        <label>Harga</label>
                        <input type="number" name="harga[]" class="form-control" value="<?= esc($detail['harga']) ?>" required />
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" class="form-select" id="status">
                    <?php $statuses = ['Menunggu', 'Dikemas', 'Dikirim', 'Selesai', 'Dibatalkan']; ?>
                    <?php foreach ($statuses as $status): ?>
                      <option value="<?= $status ?>" <?= ($pemesanan['status'] ?? $details[0]['status']) == $status ? 'selected' : '' ?>>
                        <?= $status ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-action">
              <button class="btn btn-success">Simpan Perubahan</button>
              <a href="<?= base_url('admin/dataTransaksi') ?>" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<!--   Core JS Files   -->
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../assets/js/plugin/jsvectormap/world.js"></script>

<!-- Google Maps Plugin -->
<script src="../assets/js/plugin/gmaps/gmaps.js"></script>

<!-- Sweet Alert -->
<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="../assets/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="../assets/js/setting-demo2.js"></script>

<script>
  $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
  });

  $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
  });

  $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
  });
</script>

<?= $this->endSection(); ?>