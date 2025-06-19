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
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Konfirmasi Pemesanan</h2>

        <div class="mb-4">
            <h5>Data Pemesan</h5>
            <table class="table table-striped">
                <tr>
                    <th>Nama</th>
                    <td><?= esc($user['nama']) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= esc($user['alamat']) ?></td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td><?= esc($user['no_hp']) ?></td>
                </tr>
            </table>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Jenis</th>
                    <th>Model</th>
                    <th>Ukuran</th>
                    <th>Lengan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($keranjang as $item): ?>
                    <tr>
                        <td><?= esc($item['jenis']) ?></td>
                        <td><?= esc($item['model']) ?></td>
                        <td><?= esc($item['ukuran']) ?></td>
                        <td><?= esc($item['lengan']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <!-- <p>Silakan transfer ke rekening BCA <strong>232400016 a.n. Batik Serika</strong> sejumlah total di atas.</p> -->

            <!-- <form action="<?= base_url('keranjang/bayar')
                                ?>" method="post" enctype="multipart/form-data" class="d-inline">
                <?= csrf_field()
                ?>
                <div class="mb-3 text-start">
                    <label for="bukti" class="form-label">Upload Bukti Pembayaran (jpg/png/pdf):</label>
                    <input type="file" name="bukti" id="bukti" accept=".jpg,.jpeg,.png,.pdf" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Bayar</button>
            </form> -->
            <!-- <button id="pay-button" class="btn btn-success">Bayar</button> -->
            <a id="pay-button" class="btn btn-secondary ms-2">Bayar</a>
            <a href="<?= base_url('keranjang') ?>" class="btn btn-secondary ms-2">Kembali</a>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-P5sir4QlW0e1ApA3"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function() {
        fetch("<?= base_url('keranjang/token') ?>")
            .then(response => response.json())
            .then(data => {
                if (data.token) {
                    snap.pay(data.token, {
                        onSuccess: function(result) {
                            alert("Pembayaran sukses!");
                            window.location.href = "<?= base_url('/pemesanan') ?>";
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran selesai...");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal.");
                        },
                        onClose: function() {
                            alert("Kamu menutup tanpa menyelesaikan pembayaran.");
                        }
                    });
                } else {
                    alert("Gagal mengambil token Midtrans.");
                }
            });
    });
</script>
<?= $this->endSection(); ?>