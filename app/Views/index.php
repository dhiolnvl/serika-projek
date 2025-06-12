<!DOCTYPE html>
<html lang="en">

<head>
    <title>Batik Serika</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content>
    <meta name="keywords" content>
    <meta name="description" content>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
        crossorigin="anonymous">

    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/normalize.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/vendor.css') ?>" rel="stylesheet">
    <link href="<?= base_url('style.css') ?>" rel="stylesheet">

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <div id="header-wrap">
        <header id="header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-2">
                        <div class="main-logo">
                            <a href="<?= base_url('index.php') ?>">
                                <img src="<?= base_url('images/logo-serika.png') ?>" alt="logo">
                            </a>

                        </div>

                    </div>

                    <div class="col-md-10">
                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item <?= uri_string() == '' ? 'active' : '' ?>"><a href="/">Beranda</a></li>
                                    <li class="menu-item <?= uri_string() == 'tentang' ? 'active' : '' ?>"><a href="<?= base_url("/tentang") ?>" class="nav-link">Tentang</a></li>
                                    <li class="menu-item <?= uri_string() == 'galeri' ? 'active' : '' ?>"><a href="<?= base_url("/galeri") ?>" class="nav-link">Galeri</a></li>
                                    <li class="menu-item <?= uri_string() == 'layanan' ? 'active' : '' ?>"><a href="<?= base_url("/keranjang") ?>" class="nav-link">Pesan</a></li>
                                    <li class="menu-item <?= uri_string() == 'kontak' ? 'active' : '' ?>"><a href="<?= base_url("/kontak") ?>" class="nav-link">Kontak</a></li>
                                </ul>

                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

    </div><!--header-wrap-->
    <?= $this->renderSection('content'); ?>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-item">
                        <div class="company-brand">
                            <img src="<?= base_url('images/logo-serika.png') ?>" alt="logo"
                                class="footer-logo">
                            <p>Konveksi batik berkualitas tinggi untuk
                                perusahaan, sekolah, dan komunitas. Desain
                                custom, bahan premium, pengerjaan cepat dan
                                terpercaya.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>Tentang Kami</h5>
                        <ul class="menu-list">
                            <li><a href="<?= base_url("/tentang") ?>"
                                    class="menu-item">Sejarah</a></li>
                            <li><a href="<?= base_url("/tentang") ?>" class="menu-item">Visi &
                                    Misi</a></li>
                        </ul>

                    </div>

                </div>

                <div class="col-md-2">
                    <div class="footer-menu">
                        <h5>Bantuan</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="https://wa.me/62895379119628" target="_blank">Pusat Bantuan</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= base_url("/kontak") ?>">Hubungi Kami</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">

                    <div class="footer-menu">
                        <h5>Kontak</h5>
                        <ul class="menu-list">
                            <li class="menu-item">
                                <a href="#">📞+62
                                    895-3791-19628</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">✉️batikserika@email.com</a>
                            </li>
                            <li class="menu-item">
                                <a href="#">📍Pekalongan,
                                    Indonesia</a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
            <!-- / row -->

        </div>
    </footer>

    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6">
                                <p>© 2025 Batik Serika.
                                    Template by <a
                                        href="https://www.templatesjungle.com/"
                                        target="_blank">TemplatesJungle</a></p>
                            </div>
                        </div>
                    </div><!--grid-->

                </div><!--footer-bottom-content-->
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>

</html>