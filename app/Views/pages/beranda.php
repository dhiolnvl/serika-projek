<?= $this->extend('/index');?>
<?= $this->section('content') ?>

<section id="billboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-slider pattern-overlay">
                            <div class="slider-item">
                                <div class="banner-content">
                                    <h2 class="banner-title">Konveksi Batik</h2>
                                    <p>Konveksi batik berkualitas tinggi untuk semua kalangan.
                                        Desain custom, bahan premium, pengerjaan
                                        cepat dan terpercaya.</p>
                                    <div class="btn-wrap">
                                        <a href="/keranjang"
                                            class="btn btn-outline-accent btn-accent-arrow">Pesan<i
                                                class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div><!--banner-content-->
                                <img class="batik" src="images/batikk.jpg"
                                    alt="banner"
                                    class="banner-image">
                            </div><!--slider-item-->

                        </div><!--slider-->

                    </div>
                </div>
            </div>
        </section>

<?= $this->endSection();?>