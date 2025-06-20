<?= $this->extend('admin/index'); ?>
<?= $this->section('content') ?>
<div class="container">
  <div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        <h6 class="op-7 mb-2">Admin Batik Serika</h6>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Users</p>
                  <h4 class="card-title"><?= $jumlahUser ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-luggage-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Pemesanan proses</p>
                  <h4 class="card-title"><?= $pesananBaru ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Pemesanan selesai</p>
                  <h4 class="card-title"><?= $pesananSelesai ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div
                  class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">User Online</p>
                  <h4 class="card-title"><?= $onlineUser ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">Statistik Penjualan</div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-container" style="min-height: 200px;">
              <canvas id="statisticsChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">Total Penjualan</div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-container" style="min-height: 430px;">
              <h6>Grand Total : Rp <?= number_format($totalSelesai, 0, ',', '.'); ?>
              </h6>
              <canvas id="totalPenjualanChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="page-inner">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Riwayat Transaksi</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="riwayat-datatables" class="display table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>ID Transaksi</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Detail</th>
                        <th>Total</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($transaksi as $row): ?>
                        <?php if (in_array($row['status'], ['Selesai', 'Dibatalkan'])): ?>
                          <tr>
                            <td><?= esc($row['id_p']) ?></td>
                            <td><?= esc($row['id_u']) ?></td>
                            <td><?= esc($row['nama']) ?></td>
                            <td>
                              <ul style="padding-left: 1rem;">
                                <?php
                                $items = explode('|', $row['detail_items']);
                                foreach ($items as $item): ?>
                                  <li><?= esc($item) ?></li>
                                <?php endforeach; ?>
                              </ul>
                            </td>
                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>

                            <td><span class="badge bg-success"><?= esc($row['status']) ?></span></td>

                          </tr>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- GRAFIK KATEGORI -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('statisticsChart').getContext('2d');
      const kategoriChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?= json_encode(array_column($kategoriList, 'kategori')) ?>,
          datasets: [{
            label: 'Jumlah Penjualan',
            data: <?= json_encode(array_map(fn($k) => (int)$k['jumlah'], $kategoriList)) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            borderRadius: 8
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0
              }
            }
          }
        }
      });
    </script>
    <!-- GRAFIK PENJUALAN -->
    <script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>
    <script>
      $(document).ready(function() {
        $("#riwayat-datatables").DataTable();
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const totalPenjualanChart = new Chart(document.getElementById('totalPenjualanChart'), {
        type: 'line',
        data: {
          labels: <?= json_encode(array_column($totalPerbulan, 'bulan')) ?>,
          datasets: [{
            label: 'Total Penjualan Perbulan (Rp)',
            data: <?= json_encode(array_map(fn($row) => (int)$row['total'], $totalPerbulan)) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: '#f3545d',
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#f3545d'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                }
              }
            }
          }
        }
      });
    </script>
  </div>
</div>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery-3.7.1.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->

<script src="<?= base_url("assets/js/plugin/chart.js/chart.min.js") ?>"></script>

<!-- jQuery Sparkline -->
<script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="assets/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="assets/js/kaiadmin.min.js"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="assets/js/setting-demo.js"></script>
<script src="assets/js/demo.js"></script>
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