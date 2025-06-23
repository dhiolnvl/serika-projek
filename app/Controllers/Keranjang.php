<?php

namespace App\Controllers;

use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use Config\Midtrans as MidtransSettings;

use App\Models\KeranjangModel;
use App\Models\PemesananModel;
use App\Models\DetailModel;
use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\KategoriModel;

class Keranjang extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form', 'session']);
        if (!session()->has('id_u')) {
            header('Location: ' . base_url('/login'));
            exit;
        }
    }

    public function index()
    {
        $id_user = session()->get('id_u');
        $keranjangModel = new KeranjangModel();
        $kategoriModel = new KategoriModel();
        $stokModel = new StokModel();
        $userModel = new UserModel();

        $data['keranjang'] = $keranjangModel->where('id_u', $id_user)->findAll();
        $data['stok_batik'] = $stokModel->findAll();
        $data['kategori'] = $kategoriModel->findAll();
        $data['user'] = $userModel->find($id_user);

        return view('keranjang/keranjang', $data);
    }

    public function tambah()
    {
        $model = new KeranjangModel();

        $id_user = session()->get('id_u');
        $jenis = $this->request->getPost('jenis');
        $model_batik = $this->request->getPost('model');
        $ukuran = $this->request->getPost('ukuran');
        $lengan = $this->request->getPost('lengan');
        $jumlah = (int) $this->request->getPost('jumlah');

        $hargaSatuan = $this->hitungHarga($jenis, $model_batik, $ukuran, $lengan);
        $totalHarga = $hargaSatuan * $jumlah;

        $model->insert([
            'id_u' => $id_user,
            'jenis' => $jenis,
            'model' => $model_batik,
            'ukuran' => $ukuran,
            'lengan' => $lengan,
            'jumlah' => $jumlah,
            'harga' => $totalHarga,
        ]);

        return redirect()->to('/keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    private function hitungHarga($jenis, $model, $ukuran, $lengan)
    {
        $harga = 50000;

        switch ($jenis) {
            case 'Batik 1':
            case 'Batik 2':
                $harga += 30000;
                break;
            case 'Batik 3':
            case 'Batik 4':
                $harga += 40000;
                break;
            case 'Request Batik':
                $harga += 60000;
                break;
        }

        switch ($model) {
            case 'Model 1':
            case 'Model 2':
                $harga += 15000;
                break;
            case 'Model 3':
            case 'Model 4':
                $harga += 20000;
                break;
            case 'Request Model':
                $harga += 60000;
                break;
        }

        if (in_array($ukuran, ['XL', '2XL'])) {
            $harga += 10000;
        } elseif (in_array($ukuran, ['3XL', '4XL', '5XL'])) {
            $harga += 15000;
        }

        if ($lengan === 'Lengan Panjang') {
            $harga += 5000;
        }

        return $harga;
    }

    public function hapus($id)
    {
        $model = new KeranjangModel();
        $id_user = session()->get('id_u');

        $model->where('id_k', $id)->where('id_u', $id_user)->delete();
        return redirect()->to('/keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $model = new KeranjangModel();
        $stokModel = new \App\Models\StokModel();
        $id_user = session()->get('id_u');

        $keranjang = $model->where('id_u', $id_user)->findAll();
        if (empty($keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang kosong.');
        }

        foreach ($keranjang as $item) {
            $stok = $stokModel->where('jenis', $item['jenis'])->first();
            if (!$stok || $item['jumlah'] > $stok['stok']) {
                return redirect()->to('/keranjang')->with('error', "Stok untuk {$item['jenis']} tidak mencukupi.");
            }
        }

        $userModel = new UserModel();
        $user = $userModel->where('id_u', $id_user)->first();

        $total = array_sum(array_column($keranjang, 'harga'));

        return view('keranjang/checkout', [
            'keranjang' => $keranjang,
            'total' => $total,
            'user' => $user
        ]);
    }

    // public function bayar()
    // {
    //     $id_user = session()->get('id_u');

    //     $modelKeranjang = new KeranjangModel();
    //     $modelPemesanan = new PemesananModel();
    //     $modelDetail = new DetailModel();
    //     $stokModel = new StokModel();
    //     $userModel = new UserModel();

    //     $user = $userModel->where('id_u', $id_user)->first();
    //     $keranjang = $modelKeranjang->where('id_u', $id_user)->findAll();

    //     if (empty($keranjang)) {
    //         return redirect()->to('/keranjang')->with('error', 'Keranjang kosong.');
    //     }

    //     $total = array_sum(array_map(fn($item) => (int) $item['harga'], $keranjang));

    //     $bukti = $this->request->getFile('bukti');
    //     if (!$bukti->isValid() || $bukti->hasMoved()) {
    //         return redirect()->back()->with('error', 'Gagal upload bukti pembayaran.');
    //     }

    //     $newName = $bukti->getRandomName();
    //     $bukti->move('bukti', $newName);

    //     $modelPemesanan->insert([
    //         'id_u' => $id_user,
    //         'nama' => $user['nama'],
    //         'alamat' => $user['alamat'],
    //         'no_hp' => $user['no_hp'],
    //         'total' => $total,
    //         'tanggal_pemesanan' => date('Y-m-d H:i:s'),
    //         'bukti_pembayaran' => $newName,
    //     ]);

    //     $id_pemesanan = $modelPemesanan->getInsertID();

    //     foreach ($keranjang as $item) {

    //         $modelDetail->insert([
    //             'id_p' => $id_pemesanan,
    //             'jenis' => $item['jenis'],
    //             'model' => $item['model'],
    //             'ukuran' => $item['ukuran'],
    //             'lengan' => $item['lengan'],
    //             'harga' => $item['harga'],
    //             'status' => 'Menunggu',
    //             'tanggal_pemesanan' => date('Y-m-d H:i:s')
    //         ]);

    //         $stok = $stokModel->where('jenis', $item['jenis'])->first();
    //         if (!$stok || $stok['stok'] <= 0) {
    //             return redirect()->to('/keranjang')->with('error', 'Stok batik jenis ' . $item['jenis'] . ' sedang habis.');
    //         }
    //         $stok = $stokModel->where('jenis', $item['jenis'])->first();
    //         if ($stok && $stok['stok'] > 0) {
    //             $stokBaru = $stok['stok'] - 1;

    //             $stokModel->update($stok['id'], ['stok' => $stokBaru]);
    //         }
    //     }

    //     $modelKeranjang->where('id_u', $id_user)->delete();

    //     return redirect()->to('/pemesanan')->with('success', 'Pembayaran berhasil! Bukti pembayaran diterima.');
    // }

    public function token()
    {
        $id_user = session()->get('id_u');

        $modelKeranjang  = new KeranjangModel();
        $modelPemesanan  = new PemesananModel();
        $modelDetail     = new DetailModel();
        $stokModel       = new StokModel();
        $userModel       = new UserModel();

        $user = $userModel->where('id_u', $id_user)->first();
        $keranjang = $modelKeranjang->where('id_u', $id_user)->findAll();

        if (empty($keranjang)) {
            return $this->response->setJSON(['error' => 'Keranjang kosong.']);
        }

        $total = array_sum(array_map(fn($item) => (int) $item['harga'], $keranjang));

        $modelPemesanan->insert([
            'id_u'      => $id_user,
            'nama'      => $user['nama'],
            'alamat'    => $user['alamat'],
            'no_hp'     => $user['no_hp'],
            'jumlah'    => $user['jumlah'] ?? 0,
            'total'     => $total,
            'tanggal_pemesanan' => date('Y-m-d'),
        ]);

        $id_pemesanan = $modelPemesanan->getInsertID();

        foreach ($keranjang as $item) {
            $stok = $stokModel->where('jenis', $item['jenis'])->first();

            $modelDetail->insert([
                'id_p'   => $id_pemesanan,
                'id_ktg' => $stok['id_ktg'],
                'jenis'  => $item['jenis'],
                'model'  => $item['model'],
                'ukuran' => $item['ukuran'],
                'lengan' => $item['lengan'],
                'jumlah' => $item['jumlah'],
                'harga'  => $item['harga'],
                'status' => 'Menunggu'
            ]);

            // Update stok langsung tanpa validasi
            $stokBaru = $stok['stok'] - $item['jumlah'];
            $stokModel->update($stok['id'], ['stok' => $stokBaru]);
        }

        $modelKeranjang->where('id_u', $id_user)->delete();

        // Midtrans Config
        $midtrans = new \Config\Midtrans();
        \Midtrans\Config::$serverKey    = $midtrans->serverKey;
        \Midtrans\Config::$isProduction = $midtrans->isProduction;
        \Midtrans\Config::$isSanitized  = $midtrans->isSanitized;
        \Midtrans\Config::$is3ds        = $midtrans->is3ds;

        $order_id = 'ORDER-' . time();
        $params = [
            'transaction_details' => [
                'order_id'     => $order_id,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user['nama'],
                'email'      => $user['email'] ?? 'customer@email.com',
                'phone'      => $user['no_hp'],
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        session()->set([
            'order_id'    => $order_id,
            'total_bayar' => $total
        ]);

        return $this->response->setJSON(['token' => $snapToken]);
    }

    public function notification()
    {
        $midtrans = new \Config\Midtrans();
        \Midtrans\Config::$serverKey = $midtrans->serverKey;
        \Midtrans\Config::$isProduction = $midtrans->isProduction;

        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $gross_amount = $notif->gross_amount;

        if ($transaction === 'settlement') {

            $id_user = session()->get('id_u');
            $keranjangModel = new KeranjangModel();
            $pemesananModel = new PemesananModel();
            $detailModel = new DetailModel();
            $stokModel = new StokModel();
            $userModel = new UserModel();

            $user = $userModel->where('id_u', $id_user)->first();
            $keranjang = $keranjangModel->where('id_u', $id_user)->findAll();

            $pemesananModel->insert([
                'id_u' => $id_user,
                'nama' => $user['nama'],
                'alamat' => $user['alamat'],
                'no_hp' => $user['no_hp'],
                'total' => $gross_amount,
                'tanggal_pemesanan' => date('Y-m-d H:i:s'),
            ]);

            $id_pemesanan = $pemesananModel->getInsertID();

            foreach ($keranjang as $item) {
                $detailModel->insert([
                    'id_p' => $id_pemesanan,
                    'jenis' => $item['jenis'],
                    'model' => $item['model'],
                    'ukuran' => $item['ukuran'],
                    'lengan' => $item['lengan'],
                    'harga' => $item['harga'],
                    'status' => 'Menunggu',
                    'tanggal_pemesanan' => date('Y-m-d H:i:s')
                ]);

                $stok = $stokModel->where('jenis', $item['jenis'])->first();
                if ($stok && $stok['stok'] > 0) {
                    $stokBaru = $stok['stok'] - 1;
                    $stokModel->update($stok['id'], ['stok' => $stokBaru]);
                }
            }

            $keranjangModel->where('id_u', $id_user)->delete();
        }

        return $this->response->setStatusCode(200);
    }

    public function editPelanggan($id_u)
    {
        $UserModel = new UserModel();
        $data['user'] = $UserModel->find($id_u);
        return view('/keranjang/editPelanggan', $data);
    }

    public function updatePelanggan($id_u)
    {
        $userModel = new UserModel();

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'    => $this->request->getPost('no_hp'),
        ];

        $userModel->update($id_u, $data);
        return redirect()->to('/keranjang')->with('success', 'Data berhasil diubah!');
    }
}
