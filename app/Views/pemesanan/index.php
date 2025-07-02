<?= $this->extend('/index'); ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Pesanan Saya</h2>

        <?php if (empty($pemesanan)): ?>
            <p class="text-center">Belum ada pesanan.</p>
        <?php else: ?>
            <?php foreach ($pemesanan as $no => $item): ?>
                <div class="mb-5">
                    <h5>Pesanan #<?= $no + 1 ?></h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Tanggal</th>
                            <td><?= date('d-m-Y', strtotime($item['tanggal_pemesanan'])) ?></td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>Rp <?= number_format($item['total'], 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-info"><?= esc(isset($item['status']) ? $item['status'] : '-') ?></span></td>
                            <td><?php if ($item['status'] === 'Dikirim'): ?>
                                    <form action="<?= base_url('pesanan/diterima/' . $item['id_p']) ?>" method="post" class="d-inline ms-2">
                                        <button type="submit" class="btn btn-sm" style="background-color: #c5a992; color: white; padding: 4px 12px; border-radius: 4px; text-transform: uppercase;" onclick="return confirm('Apakah Anda yakin telah menerima pesanan ini?')">
                                            PESANAN DITERIMA
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                    <h6>Detail Pemesanan:</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Model</th>
                                    <th>Ukuran</th>
                                    <th>Lengan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($item['detail'] as $d): ?>
                                    <tr>
                                        <td><?= esc($d['jenis']) ?></td>
                                        <td><?= esc($d['model']) ?></td>
                                        <td><?= esc($d['ukuran']) ?></td>
                                        <td><?= esc($d['lengan']) ?></td>
                                        <td><?= esc($d['jumlah']) ?></td>
                                        <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $no_hp_toko = '62895379119628';
                    $pesan = "Halo, saya ingin konfirmasi pesanan dengan ID: " . $item['id_p'] .
                        ".\nTanggal Pemesanan: " . date('d-m-Y H:i', strtotime($item['tanggal_pemesanan'])) .
                        "\nTotal: Rp " . number_format($item['total'], 0, ',', '.') .
                        "\nStatus: " . $item['status'] .
                        "\nTerima kasih.";
                    $link_wa = "https://wa.me/{$no_hp_toko}?text=" . urlencode($pesan);
                    ?>
                    <a href="<?= $link_wa ?>" target="_blank" class="btn btn-secondary ms-2" style="background-color: #25D366; color: white; padding: 10px 20px; border-radius: 4px; text-transform: uppercase;">
                        KONFIRMASI VIA WA
                    </a>
                    <br>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <a href="<?= base_url('keranjang') ?>" class="btn btn-secondary ms-2">Kembali</a>
    </div>
</div>

<?= $this->endSection(); ?>