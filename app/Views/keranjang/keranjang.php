<?= $this->extend('/index'); ?>
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

<div class="container py-5">
    <div class="mb-4">
        <h3>Selamat datang, <?= session()->get('username'); ?>!</h3>
    </div>

    <div class="mb-4 text-end">
        <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger">Logout</a>
    </div>

    <div class="mb-4 text-end">
        <a href="<?= base_url('/pemesanan') ?>" class="btn btn-outline-danger">Cek Pemesanan</a>
    </div>

    <div class="mb-4 text-end">
        <a href="<?= base_url('/keranjang/editPelanggan/' . $user['id_u']) ?>" class="btn btn-outline-danger">Edit Profil</a>
    </div>

    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Form Pemesanan Batik</h2>
        <div class="mb-4">
            <h6>Panduan Ukuran:</h6>
            <a href="<?= base_url('images/size1.jpg') ?>">Lihat</a>
        </div>
        <div class="mb-4">
            <select id="filterKategori" class="form-select">
                <option value="">-- Kategori Batik --</option>
                <?php foreach ($kategori as $ktg): ?>
                    <option value="<?= esc($ktg['id_ktg']) ?>"><?= esc($ktg['kategori']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <form action="<?= base_url('keranjang/tambah') ?>" method="post">
            <?= csrf_field() ?>

            <input type="hidden" name="jenis" id="jenisInput">
            <input type="hidden" name="model" id="modelInput">

            <h5>Pilih Jenis Batik:</h5>
            <div class="mb-4">
                <div class="mb-4 d-flex flex-wrap gap-3">
                    <?php foreach ($stok_batik as $batik): ?>
                        <div class="text-center">
                            <img src="/uploads/<?= esc($batik['gambar']) ?>"
                                class="pilihan-batik"
                                data-value="<?= esc($batik['jenis']) ?>"
                                data-stok="<?= esc($batik['stok']) ?>"
                                data-kategori="<?= esc($batik['id_ktg']) ?>"
                                width="100">

                            <div>Stok: <?= $batik['stok'] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <h6>*Wajib memilih.</h6>
            <br>
            <h5>Pilih Model:</h5>
            <div class="mb-4">
                <img src="/images/model1.png" class="pilihan-model" data-value="Model 1" width="100">
                <img src="/images/model2.png" class="pilihan-model" data-value="Model 2" width="100">
                <img src="/images/model3.png" class="pilihan-model" data-value="Model 3" width="100">
                <img src="/images/model4.png" class="pilihan-model" data-value="Model 4" width="100">
                <img src="/images/reqmodel.png" class="pilihan-model" data-value="Request Model" width="100">
            </div>
            <h6>*Wajib memilih.</h6>
            <br>

            <div class="row mb-3">
                <div class="col">
                    <select name="ukuran" class="form-select" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="2XL">2XL</option>
                        <option value="3XL">3XL</option>
                        <option value="4XL">4XL</option>
                        <option value="5XL">5XL</option>
                    </select>
                </div>
                <div class="col">
                    <select name="lengan" class="form-select" required>
                        <option value="">Pilih Lengan</option>
                        <option value="Lengan Panjang">Lengan Panjang</option>
                        <option value="Lengan Pendek">Lengan Pendek</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah:</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="1" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
            </div>
        </form>
    </div>

    <?php if ($keranjang): ?>
        <div class="card shadow p-4 mt-5">
            <h4 class="mb-4">Keranjang Belanja</h4>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Jenis</th>
                        <th>Model</th>
                        <th>Ukuran</th>
                        <th>Lengan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($keranjang as $item): ?>
                        <tr>
                            <td><?= esc($item['jenis']) ?></td>
                            <td><?= esc($item['model']) ?></td>
                            <td><?= esc($item['ukuran']) ?></td>
                            <td><?= esc($item['lengan']) ?></td>
                            <td><?= esc($item['jumlah']) ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <a href="<?= base_url("keranjang/hapus/" . $item['id_k']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php $total += $item['harga']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="5" class="text-end">Total</th>
                        <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tbody>
            </table>
            <div class="d-grid mt-4">
                <a href="<?= base_url('/checkout') ?>" class="btn btn-primary">Checkout Sekarang</a>
            </div>
        </div>
    <?php endif; ?>

</div>

<script>
    document.getElementById('filterKategori').addEventListener('change', function() {
        const selectedKategori = this.value;
        document.querySelectorAll('.pilihan-batik').forEach(img => {
            if (selectedKategori === '' || img.dataset.kategori === selectedKategori) {
                img.parentElement.style.display = 'block';
            } else {
                img.parentElement.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.pilihan-batik').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('jenisInput').value = this.dataset.value;
            alert("Jenis batik dipilih: " + this.dataset.value);
        });
    });
    document.querySelectorAll('.pilihan-model').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('modelInput').value = this.dataset.value;
            alert("Model dipilih: " + this.dataset.value);
        });
    });
</script>

<?= $this->endSection(); ?>