<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        h2 {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .summary {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>BATIK SERIKA</h1>
        <h2>Laporan Transaksi</h2>
    </div>

    <?php if (!empty($tanggal_awal) && !empty($tanggal_akhir)): ?>
        <p><strong>Periode:</strong> <?= date('d-m-Y', strtotime($tanggal_awal)) ?> sampai <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></p>
    <?php elseif (!empty($tanggal_awal)): ?>
        <p><strong>Dari Tanggal:</strong> <?= date('d-m-Y', strtotime($tanggal_awal)) ?></p>
    <?php elseif (!empty($tanggal_akhir)): ?>
        <p><strong>Sampai Tanggal:</strong> <?= date('d-m-Y', strtotime($tanggal_akhir)) ?></p>
    <?php endif; ?>

    <?php if (!empty($kategori)): ?>
        <?php
        $kategoriNama = '';
        foreach ($kategoriList as $k) {
            if ($k['id_ktg'] == $kategori) {
                $kategoriNama = $k['kategori'];
                break;
            }
        }
        ?>
        <p><strong>Kategori:</strong> <?= $kategoriNama ?></p>
    <?php endif; ?>


    <table>
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Detail</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $t): ?>
                <tr>
                    <td><?= $t['id_p'] ?></td>
                    <td><?= $t['nama'] ?></td>
                    <td><?= $t['no_hp'] ?></td>
                    <td>
                        <?php
                        $items = explode('|', $t['detail_items']);
                        foreach ($items as $item) {
                            echo $item . '<br>';
                        }
                        ?>
                    </td>
                    <td>Rp <?= number_format($t['total_harga'], 0, ',', '.') ?></td>
                    <td><?= $t['status'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Penjualan (Selesai):</strong> Rp <?= number_format($totalSelesai, 0, ',', '.') ?></p>

        <?php
        $totalItemKeseluruhan = array_sum(array_column($kategoriList, 'jumlah'));
        ?>

        <p><strong>Total Item Terjual:</strong> <?= $totalItemKeseluruhan ?> item</p>

        <p><strong>Rekap per Kategori:</strong></p>
        <ul>
            <?php foreach ($kategoriList as $k): ?>
                <li><?= $k['kategori'] ?>: <?= $k['jumlah'] ?> item</li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>