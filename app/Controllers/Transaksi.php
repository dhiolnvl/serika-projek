<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\UserModel;
use Dompdf\Dompdf;

class Transaksi extends BaseController
{

    public function dataTransaksi()
    {
        $db = \Config\Database::connect();
        $bulan = $this->request->getGet('bulan'); // Ambil parameter bulan dari URL

        $builder = $db->table('pemesanan_detail')
            ->select(
                'pemesanan.id_p,
         pemesanan.id_u,
         pemesanan.nama,
         pemesanan.tanggal_pemesanan,
         pemesanan_detail.status,
         SUM(pemesanan_detail.harga) as total_harga,
         GROUP_CONCAT(CONCAT(
             pemesanan_detail.jenis, " - ",
             pemesanan_detail.model, " - ",
             pemesanan_detail.ukuran, " - ",
             pemesanan_detail.lengan, " - Rp ",
             pemesanan_detail.harga
         ) SEPARATOR "|") AS detail_items'
            )
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->whereNotIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        // Filter jika ada input bulan
        if (!empty($bulan)) {
            $builder->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        $data['transaksi'] = $query->getResultArray();
        $data['bulan'] = $bulan;

        return view('admin/tables/dataTransaksi', $data);
    }



    public function editTransaksi($id_p)
    {
        $db = \Config\Database::connect();

        $pemesanan = $db->table('pemesanan')->where('id_p', $id_p)->get()->getRowArray();

        $details = $db->table('pemesanan_detail')->where('id_p', $id_p)->get()->getResultArray();

        if (!$pemesanan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('admin/forms/editTransaksi', [
            'pemesanan' => $pemesanan,
            'details'   => $details
        ]);
    }

    public function updateTransaksi($id_p)
    {
        $db = \Config\Database::connect();

        $db->table('pemesanan')->where('id_p', $id_p)->update([
            'id_u' => $this->request->getPost('id_u'),
        ]);

        $status   = $this->request->getPost('status');
        $detailId = $this->request->getPost('detail_id');
        $jenis    = $this->request->getPost('jenis');
        $model    = $this->request->getPost('model');
        $ukuran   = $this->request->getPost('ukuran');
        $lengan   = $this->request->getPost('lengan');
        $harga    = $this->request->getPost('harga');

        for ($i = 0; $i < count($detailId); $i++) {
            $db->table('pemesanan_detail')
                ->where('id_detail', $detailId[$i])
                ->update([
                    'jenis'  => $jenis[$i],
                    'model'  => $model[$i],
                    'ukuran' => $ukuran[$i],
                    'lengan' => $lengan[$i],
                    'harga'  => $harga[$i],
                    'status' => $status
                ]);
        }

        return redirect()->to('/admin/dataTransaksi')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function deleteTransaksi($id_p)
    {
        $db = \Config\Database::connect();

        $db->table('pemesanan_detail')->where('id_p', $id_p)->delete();

        $db->table('pemesanan')->where('id_p', $id_p)->delete();

        return redirect()->to('/admin/dataTransaksi')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function riwayatTransaksi()
    {
        $db = \Config\Database::connect();
        $bulan = $this->request->getGet('bulan');
        $kategori = $this->request->getGet('kategori');

        $builder = $db->table('pemesanan_detail')
            ->select(
                'pemesanan.id_p,
             pemesanan.id_u,
             pemesanan.nama,
             pemesanan.tanggal_pemesanan,
             users.no_hp,
             pemesanan_detail.status,
             kategori.kategori,
             SUM(pemesanan_detail.harga) as total_harga,
             GROUP_CONCAT(CONCAT(
                 pemesanan_detail.jenis, " - ",
                 pemesanan_detail.model, " - ",
                 pemesanan_detail.ukuran, " - ",
                 pemesanan_detail.lengan, " - Rp ",
                 pemesanan_detail.harga
             ) SEPARATOR "|") AS detail_items'
            )
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->join('users', 'users.id_u = pemesanan.id_u')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        if (!empty($bulan)) {
            $builder->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        if (!empty($kategori)) {
            $builder->where('kategori.id_ktg', $kategori);
        }

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        // Total selesai
        $totalSelesaiQuery = $db->table('pemesanan_detail')
            ->selectSum('pemesanan_detail.harga')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->where('pemesanan_detail.status', 'Selesai');

        if (!empty($bulan)) {
            $totalSelesaiQuery->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        if (!empty($kategori)) {
            $totalSelesaiQuery->where('kategori.id_ktg', $kategori);
        }

        $totalSelesai = $totalSelesaiQuery->get()->getRow()->harga ?? 0;

        $kategoriList = $db->table('pemesanan_detail')
            ->select('kategori.id_ktg, kategori.kategori, COUNT(*) as jumlah')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p') // untuk akses tanggal
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        if (!empty($bulan)) {
            $kategoriList->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        $kategoriList = $kategoriList
            ->groupBy('kategori.id_ktg')
            ->get()
            ->getResultArray();


        return view('admin/tables/riwayatTransaksi', [
            'transaksi'     => $query->getResultArray(),
            'totalSelesai'  => $totalSelesai,
            'bulan'         => $bulan,
            'kategori'      => $kategori,
            'kategoriList'  => $kategoriList,
        ]);
    }
    public function cetakPdf()
    {
        $bulan = $this->request->getGet('bulan');
        $kategori = $this->request->getGet('kategori');

        $data = $this->getRiwayatData($bulan, $kategori);

        $dompdf = new Dompdf();
        $html = view('admin/export/riwayat_pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("riwayat-transaksi.pdf");
    }

    private function getRiwayatData($bulan, $kategori)
    {
        $db = \Config\Database::connect();
        $bulan = $this->request->getGet('bulan');
        $kategori = $this->request->getGet('kategori');

        $builder = $db->table('pemesanan_detail')
            ->select(
                'pemesanan.id_p,
             pemesanan.id_u,
             pemesanan.nama,
             pemesanan.tanggal_pemesanan,
             users.no_hp,
             pemesanan_detail.status,
             kategori.kategori,
             SUM(pemesanan_detail.harga) as total_harga,
             GROUP_CONCAT(CONCAT(
                 pemesanan_detail.jenis, " - ",
                 pemesanan_detail.model, " - ",
                 pemesanan_detail.ukuran, " - ",
                 pemesanan_detail.lengan, " - Rp ",
                 pemesanan_detail.harga
             ) SEPARATOR "|") AS detail_items'
            )
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->join('users', 'users.id_u = pemesanan.id_u')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        if (!empty($bulan)) {
            $builder->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        if (!empty($kategori)) {
            $builder->where('kategori.id_ktg', $kategori);
        }

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        // Total selesai
        $totalSelesaiQuery = $db->table('pemesanan_detail')
            ->selectSum('pemesanan_detail.harga')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->where('pemesanan_detail.status', 'Selesai');

        if (!empty($bulan)) {
            $totalSelesaiQuery->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        if (!empty($kategori)) {
            $totalSelesaiQuery->where('kategori.id_ktg', $kategori);
        }

        $totalSelesai = $totalSelesaiQuery->get()->getRow()->harga ?? 0;

        $kategoriList = $db->table('pemesanan_detail')
            ->select('kategori.id_ktg, kategori.kategori, COUNT(*) as jumlah')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p') // untuk akses tanggal
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        if (!empty($bulan)) {
            $kategoriList->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        $kategoriList = $kategoriList
            ->groupBy('kategori.id_ktg')
            ->get()
            ->getResultArray();

        return [
            'transaksi'     => $query->getResultArray(),
            'totalSelesai'  => $totalSelesai,
            'bulan'         => $bulan,
            'kategori'      => $kategori,
            'kategoriList'  => $kategoriList,
        ];
    }
}
