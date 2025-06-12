<?= $this->extend('/index');?>
<?= $this->section('content') ?>

<section id="kontak" class="py-0 my-2">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-12 text-center">
                        <div class="section-header">
                            <h2 class="section-title">Kontak Kami</h2>
                            <p class="section-subtitle">Hubungi kami melalui
                                kontak di bawah ini untuk pertanyaan, pemesanan,
                                atau kerja sama.</p>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center text-center"
                    data-aos="fade-up">
                    <div class="col-md-4 mb-4">
                        <div class="p-4 border rounded shadow-sm h-100">
                            <div class="mb-2" style="font-size: 32px;">📞</div>
                            <h5>Telepon / WhatsApp</h5>
                            <a href="https://wa.me/6281234567890"
                                target="_blank" class="text-dark">+62
                                895-3791-19628</a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="p-4 border rounded shadow-sm h-100">
                            <div class="mb-2" style="font-size: 32px;">✉️</div>
                            <h5>Email</h5>
                            <a href="mailto:batikserika@email.com"
                                class="text-dark">batikserika@email.com</a>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="p-4 border rounded shadow-sm h-100">
                            <div class="mb-2" style="font-size: 32px;">📍</div>
                            <h5>Alamat</h5>
                            <p class="mb-0">Jl. Setono Gg.2 Gotong royong
                                <br>Kota
                                Pekalongan, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
<?= $this->endSection();?>