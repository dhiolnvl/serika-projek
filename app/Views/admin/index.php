<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Admin Batik Serika</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="<?= base_url('/images/logo2.jpg') ?>" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="<?= base_url('assets/js/plugin/webfont/webfont.min.js') ?>"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons"
        ],
        urls: ["<?= base_url('assets/css/bootstrap.min.css') ?>"]
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/plugins.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/kaiadmin.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/demo.css') ?>" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="light">
      <div class="sidebar-logo">
        <div class="logo-header" data-background-color="light">
          <a href="<?= base_url("/admin") ?>" class="logo">
            <img src="<?= base_url('images/logo-serika.png') ?>" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
            <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
          </div>
          <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-section"><span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">UTAMA</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#dashboard" role="button" aria-expanded="false" aria-controls="dashboard">
                <i class="fas fa-home"></i>
                <p>Admin</p><span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin") ?>"><span class="sub-item">Dashboard</span></a></li>
                </ul>
              </div>
            </li>
            <!-- Kelola Batik -->
            <li class="nav-section"><span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">KELOLA BATIK</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#kategori" role="button" aria-expanded="false" aria-controls="kategori">
                <i class="fas fa-pen-square"></i>
                <p>Kategori</p><span class="caret"></span>
              </a>
              <div class="collapse" id="kategori">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin/inputKategori") ?>"><span class="sub-item">Input Kategori</span></a></li>
                  <li><a href="<?= base_url("/admin/dataKategori") ?>"><span class="sub-item">Lihat Kategori</span></a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#jenis" role="button" aria-expanded="false" aria-controls="jenis">
                <i class="fas fa-pen-square"></i>
                <p>Jenis</p><span class="caret"></span>
              </a>
              <div class="collapse" id="jenis">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin/inputStok") ?>"><span class="sub-item">Input Jenis</span></a></li>
                  <li><a href="<?= base_url("/admin/dataStok") ?>"><span class="sub-item">Lihat Jenis</span></a></li>
                </ul>
              </div>
            </li>
            <!-- Kelola Akun -->
            <li class="nav-section"><span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">KELOLA AKUN</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
                <i class="fas fa-pen-square"></i>
                <p>Input Data</p><span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin/inputAdmin") ?>"><span class="sub-item">Admin</span></a></li>
                  <li><a href="<?= base_url("/admin/inputPelanggan") ?>"><span class="sub-item">Pelanggan</span></a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#tables" role="button" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-table"></i>
                <p>Lihat Data</p><span class="caret"></span>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin/dataAdmin") ?>"><span class="sub-item">Admin</span></a></li>
                  <li><a href="<?= base_url("/admin/dataPelanggan") ?>"><span class="sub-item">Pelanggan</span></a></li>
                </ul>
              </div>
            </li>
            <!-- Kelola Transaksi -->
            <li class="nav-section"><span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
              <h4 class="text-section">KELOLA TRANSAKSI</h4>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#transaksi" role="button" aria-expanded="false" aria-controls="transaksi">
                <i class="fas fa-pen-square"></i>
                <p>Transaksi</p><span class="caret"></span>
              </a>
              <div class="collapse" id="transaksi">
                <ul class="nav nav-collapse">
                  <li><a href="<?= base_url("/admin/dataTransaksi") ?>"><span class="sub-item">Data Transaksi</span></a></li>
                  <li><a href="<?= base_url("/admin/dataRiwayat") ?>"><span class="sub-item">Riwayat Transaksi</span></a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="light">
            <a href="<?= base_url("/admin") ?>" class="logo">
              <img
                src="<?= base_url('images/logo-serika.png') ?>"
                alt="navbar brand"
                class="navbar-brand"
                height="20" />
            </a>
            <div class="nav-toggle d-block d-lg-none">
              <button class="btn btn-dark toggle-sidebar me-1">
                <i class="fas fa-bars"></i>
              </button>
            </div>
          </div>

        </div>
        <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false">
                  <div class="avatar-sm">
                    <img
                      src="<?= base_url('images/user.png') ?>"
                      alt="..."
                      class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold"><?= session()->get('username'); ?></span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img
                            src="<?= base_url('images/user.png') ?>"
                            alt="image profile"
                            class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4><?= session()->get('username'); ?></h4>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?= base_url('/logoutAdmin') ?>">Logout</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <?= $this->renderSection('content'); ?>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left"></nav>
          <div class="copyright">
            2025, made with <span class="text-danger">❤️</span> by
            <a href="http://dlinovl.netlify.app">Kelompok 2</a>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/js/core/jquery-3.7.1.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/chart.js/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/chart-circle/circles.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/jsvectormap/jsvectormap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/jsvectormap/world.js') ?>"></script>
  <script src="<?= base_url('assets/js/plugin/sweetalert/sweetalert.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/kaiadmin.min.js') ?>"></script>
  <script>
    $(function() {
      $('#lineChart').sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)"
      });

      $('#lineChart2').sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)"
      });

      $('#lineChart3').sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)"
      });
    });
  </script>
</body>

</html>