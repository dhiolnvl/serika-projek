<?= $this->extend('/admin/index'); ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Transaksi</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/admin/dataTransaksi') ?>">Data Transaksi</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="GET" class="mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="bulan">Filter Bulan:</label>
                                        <input type="month" id="bulan" name="bulan" class="form-control" value="<?= esc($_GET['bulan'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kategori">Filter Kategori:</label>
                                        <select id="kategori" name="kategori" class="form-control">
                                            <option value="">-- Semua Kategori --</option>
                                            <?php foreach ($kategoriList as $k): ?>
                                                <option value="<?= esc($k['id_ktg']) ?>" <?= ($kategori == $k['id_ktg']) ? 'selected' : '' ?>>
                                                    <?= esc($k['kategori']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5 align-self-end">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="<?= base_url('/admin/dataRiwayat') ?>" class="btn btn-secondary">Reset</a>
                                        <a href="<?= base_url('/transaksi/cetakPdf?' . http_build_query($_GET)) ?>" target="_blank" class="btn btn-danger">
                                            <i class="fas fa-file-pdf"></i> Cetak PDF
                                        </a>
                                    </div>

                                </div>
                            </form>

                            <table id="riwayat-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama</th>
                                        <th>Detail</th>
                                        <th>Total</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                        <th>Nota</th>
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
                                                <td>
                                                    <?php if ($row['bukti_pembayaran']): ?>
                                                        <a href="<?= base_url('bukti/' . $row['bukti_pembayaran']) ?>" target="_blank">Lihat</a>
                                                    <?php else: ?>
                                                        <span class="text-muted">Belum upload</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><span class="badge bg-success"><?= esc($row['status']) ?></span></td>
                                                <td>
                                                    <a
                                                        class="btn btn-success btn-sm"
                                                        target="_blank"
                                                        href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $row['no_hp']) ?>?text=<?= rawurlencode(
                                                                                                                                        "Halo " . $row['nama'] . ",\n\nTerima kasih atas pesanan Anda!\n\n" .
                                                                                                                                            "ID Transaksi: " . $row['id_p'] . "\n" .
                                                                                                                                            "Total: Rp " . number_format($row['total_harga'], 0, ',', '.') . "\n\n" .
                                                                                                                                            "Detail:\n" . str_replace('|', "\n", $row['detail_items']) . "\n\n" .
                                                                                                                                            "Silakan hubungi kami jika ada pertanyaan."
                                                                                                                                    ) ?>">
                                                        Kirim Nota
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="row mt-4">
                                <!-- Kolom Kategori -->
                                <div class="col-md-6">
                                    <h5 class="fw-bold">Rekap Pembelian per Kategori:</h5>
                                    <ul class="mb-0">
                                        <?php foreach ($kategoriList as $k): ?>
                                            <li><?= esc($k['kategori']) ?>: <strong><?= esc($k['jumlah']) ?></strong> item</li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <!-- Kolom Total -->
                                <div class="col-md-6 text-end">
                                    <h5 class="fw-bold">Total Pembelian:</h5>
                                    <p class="fs-5 fw-bold">Rp. <?= number_format($totalSelesai, 0, ',', '.'); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/plugin/datatables/datatables.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $("#riwayat-datatables").DataTable();
    });
</script>

<?= $this->endSection(); ?>