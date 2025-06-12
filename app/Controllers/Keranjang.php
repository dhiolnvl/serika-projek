<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\PemesananModel;
use App\Models\DetailModel;
use App\Models\StokModel;
use App\Models\UserModel;

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
        $stokModel = new StokModel();

        $data['keranjang'] = $keranjangModel->where('id_u', $id_user)->findAll();
        $data['stok_batik'] = $stokModel->findAll();

        return view('keranjang/keranjang', $data);
    }

    public function simpanDataDiri()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        session()->set('nama', $this->request->getPost('nama'));
        session()->set('alamat', $this->request->getPost('alamat'));

        return redirect()->to('/keranjang');
    }

    public function tambah()
    {
        $model = new KeranjangModel();

        $id_user = session()->get('id_u');
        $jenis = $this->request->getPost('jenis');
        $model_batik = $this->request->getPost('model');
        $ukuran = $this->request->getPost('ukuran');
        $lengan = $this->request->getPost('lengan');

        $harga = $this->hitungHarga($jenis, $model_batik, $ukuran, $lengan);

        $model->insert([
            'id_u' => $id_user,
            'jenis' => $jenis,
            'model' => $model_batik,
            'ukuran' => $ukuran,
            'lengan' => $lengan,
            'harga' => $harga,
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
        $id_user = session()->get('id_u');

        $keranjang = $model->where('id_u', $id_user)->findAll();
        if (empty($keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang kosong.');
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

    public function bayar()
    {
        $id_user = session()->get('id_u');

        $modelKeranjang = new KeranjangModel();
        $modelPemesanan = new PemesananModel();
        $modelDetail = new DetailModel();
        $stokModel = new StokModel();
        $userModel = new UserModel();

        $user = $userModel->where('id_u', $id_user)->first();
        $keranjang = $modelKeranjang->where('id_u', $id_user)->findAll();

        if (empty($keranjang)) {
            return redirect()->to('/keranjang')->with('error', 'Keranjang kosong.');
        }

        $total = array_sum(array_map(fn($item) => (int) $item['harga'], $keranjang));

        $bukti = $this->request->getFile('bukti');
        if (!$bukti->isValid() || $bukti->hasMoved()) {
            return redirect()->back()->with('error', 'Gagal upload bukti pembayaran.');
        }

        $newName = $bukti->getRandomName();
        $bukti->move('bukti', $newName);

        $modelPemesanan->insert([
            'id_u' => $id_user,
            'nama' => $user['nama'],
            'alamat' => $user['alamat'],
            'no_hp' => $user['no_hp'],
            'total' => $total,
            'tanggal_pemesanan' => date('Y-m-d H:i:s'),
            'bukti_pembayaran' => $newName,
        ]);

        $id_pemesanan = $modelPemesanan->getInsertID();

        foreach ($keranjang as $item) {
            // 1. Tambahkan ke tabel detail
            $modelDetail->insert([
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
            if (!$stok || $stok['stok'] <= 0) {
                return redirect()->to('/keranjang')->with('error', 'Stok batik jenis ' . $item['jenis'] . ' sedang habis.');
            }
            $stok = $stokModel->where('jenis', $item['jenis'])->first();
            if ($stok && $stok['stok'] > 0) {
                $stokBaru = $stok['stok'] - 1;

                $stokModel->update($stok['id'], ['stok' => $stokBaru]);
            }
        }

        // 3. Kosongkan keranjang
        $modelKeranjang->where('id_u', $id_user)->delete();

        return redirect()->to('/pemesanan')->with('success', 'Pembayaran berhasil! Bukti pembayaran diterima.');
    }
}
