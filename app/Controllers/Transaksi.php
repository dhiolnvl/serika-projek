<?php

namespace App\Controllers;

use App\Models\PemesananModel;
use App\Models\UserModel;

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
         pemesanan.bukti_pembayaran,
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

        $builder = $db->table('pemesanan_detail')
            ->select(
                'pemesanan.id_p,
         pemesanan.id_u,
         pemesanan.nama,
         users.no_hp,
         pemesanan.bukti_pembayaran,
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
            ->join('users', 'users.id_u = pemesanan.id_u')
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);


        if (!empty($bulan)) {

            $builder->where("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') =", $bulan);
        }

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        $data['transaksi'] = $query->getResultArray();
        $data['bulan'] = $bulan;

        return view('admin/tables/riwayatTransaksi', $data);
    }
}
