<?= $this->extend('/index'); ?>
<?= $this->section('content') ?>
<section id="galeri" class="py-0 my-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header align-center">
                    <h2 class="section-title">Galeri Batik</h2>
                </div>

                <div class="product-list" data-aos="fade-up">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="images/galeri1.png"
                                        alt="batik"
                                        class="product-item">
                                </figure>
                                <figcaption>
                                    <h3>Batik Pekalongan Pria</h3>
                                    <div class="item-price">Rp.
                                        100.000</div>
                                </figcaption>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="images/galeri2.png"
                                        alt="batik"
                                        class="product-item">
                                </figure>
                                <figcaption>
                                    <h3>Batik Semarang Pria</h3>
                                    <div class="item-price">Rp.
                                        90.000</div>
                                </figcaption>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="images/galeri3.png"
                                        alt="batik"
                                        class="product-item">

                                </figure>
                                <figcaption>
                                    <h3>Batik Solo Wanita</h3>
                                    <div class="item-price">Rp.
                                        150.000</div>
                                </figcaption>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="images/galeri4.png"
                                        alt="batik"
                                        class="product-item">
                                </figure>
                                <figcaption>
                                    <h3>Batik Jogja Wanita</h3>
                                    <div class="item-price">Rp.
                                        210.000</div>
                                </figcaption>
                            </div>
                        </div>

                        <div class="btn-wrap align-right">
                            <p>Harga Bisa Berbeda, Tergantung
                                Pemesanan.</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>