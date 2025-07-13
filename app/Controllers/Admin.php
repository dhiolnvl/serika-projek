<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KategoriModel;
use App\Models\UserModel;
use App\Models\StokModel;

class Admin extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $jumlahUser = $userModel->countAll();

        $db = \Config\Database::connect();
        $now = time();

        $onlineUser = $db->table('online_users')
            ->where('last_activity >=', $now - 600)
            ->countAllResults();

        $pesananBaru = $db->table('pemesanan_detail')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->whereNotIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan'])
            ->groupBy('pemesanan.id_p')
            ->get()
            ->getNumRows();

        $pesananSelesai = $db->table('pemesanan_detail')
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->whereIn('pemesanan_detail.status', ['Selesai'])
            ->groupBy('pemesanan.id_p')
            ->get()
            ->getNumRows();

        $totalSelesai = $db->table('pemesanan_detail')
            ->select('SUM(harga) AS total')
            ->where('status', 'Selesai')
            ->get()
            ->getRow()
            ->total;

        $totalPerbulan = $db->table('pemesanan_detail')
            ->select("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m') AS bulan, SUM(pemesanan_detail.harga) as total")
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->whereIn('pemesanan_detail.status', ['Selesai'])
            ->groupBy("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m')")
            ->orderBy("DATE_FORMAT(pemesanan.tanggal_pemesanan, '%Y-%m')")
            ->get()
            ->getResultArray();

        $totalPerhari = $db->table('pemesanan_detail')
            ->select("DATE(pemesanan.tanggal_pemesanan) AS tanggal, SUM(pemesanan_detail.harga) as total")
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->whereIn('pemesanan_detail.status', ['Selesai'])
            ->groupBy("DATE(pemesanan.tanggal_pemesanan)")
            ->orderBy("DATE(pemesanan.tanggal_pemesanan)")
            ->get()
            ->getResultArray();

        $builder = $db->table('pemesanan_detail')
            ->select(
                'pemesanan.id_p,
                 pemesanan.id_u,
                 pemesanan.nama,
                 users.no_hp,
                 pemesanan_detail.status,
                 SUM(pemesanan_detail.harga) as total_harga,
                 GROUP_CONCAT(CONCAT(
                     pemesanan_detail.jenis, " - ",
                     pemesanan_detail.model, " - ",
                     pemesanan_detail.ukuran, " - ",
                     pemesanan_detail.lengan, " - Jumlah: ",
                     pemesanan_detail.jumlah, " - Rp ",
                     pemesanan_detail.harga
                 ) SEPARATOR "|") AS detail_items'
            )
            ->join('pemesanan', 'pemesanan.id_p = pemesanan_detail.id_p')
            ->join('users', 'users.id_u = pemesanan.id_u')
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan']);

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        $kategoriList = $db->table('pemesanan_detail')
            ->select('kategori.kategori, SUM(pemesanan_detail.jumlah) as jumlah')
            ->join('kategori', 'kategori.id_ktg = pemesanan_detail.id_ktg')
            ->whereIn('pemesanan_detail.status', ['Selesai', 'Dibatalkan'])
            ->groupBy('kategori.kategori')
            ->get()
            ->getResultArray();


        $data['transaksi'] = $query->getResultArray();

        return view('admin/dashboard', array_merge([
            'jumlahUser'     => $jumlahUser,
            'pesananBaru'    => $pesananBaru,
            'pesananSelesai' => $pesananSelesai,
            'totalSelesai'   => $totalSelesai,
            'totalPerbulan'  => $totalPerbulan,
            'totalPerhari'  => $totalPerhari,
            'kategoriList'   => $kategoriList,
            'onlineUser'     => $onlineUser,
        ], $data));
    }

    public function inputAdmin()
    {

        return view('admin/forms/inputAdmin');
    }

    public function inputPelanggan()
    {
        // $id_user = session()->get('id_a');

        return view('admin/forms/inputPelanggan');
    }

    public function dataAdmin()
    {
        $id_user = session()->get('id_a');

        $adminModel = new AdminModel();
        $data['admins'] = $adminModel->findAll();

        return view('admin/tables/dataAdmin', $data);
    }

    public function dataPelanggan()
    {
        $id_user = session()->get('id_a');

        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/tables/dataPelanggan', $data);
    }

    public function saveAdmin()
    {
        $model = new AdminModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'     => $this->request->getPost('no_hp'),
        ];

        $model->insert($data);
        return redirect()->to('/admin/inputAdmin')->with('success', 'Data berhasil disimpan!');
    }
    public function savePelanggan()
    {
        $modelUser = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'status'    => $this->request->getPost('status'),
        ];

        $modelUser->insert($data);
        return redirect()->to('/admin/inputPelanggan')->with('success', 'Data berhasil disimpan!');
    }

    public function editAdmin($id_a)
    {
        $adminModel = new AdminModel();
        $data['admin'] = $adminModel->find($id_a);
        return view('/admin/forms/editAdmin', $data);
    }

    public function updateAdmin($id_a)
    {
        $adminModel = new AdminModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'    => $this->request->getPost('no_hp'),
        ];

        $adminModel->update($id_a, $data);
        return redirect()->to('/admin/dataAdmin')->with('success', 'Data admin berhasil diubah!');
    }

    public function deleteAdmin($id_a)
    {
        $adminModel = new AdminModel();
        $adminModel->delete($id_a);
        return redirect()->to('/admin/dataAdmin')->with('success', 'Data admin berhasil dihapus!');
    }

    public function editPelanggan($id_u)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id_u);
        return view('/admin/forms/editPelanggan', $data);
    }

    public function updatePelanggan($id_u)
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama'     => $this->request->getPost('nama'),
            'alamat'   => $this->request->getPost('alamat'),
            'no_hp'    => $this->request->getPost('no_hp'),
            'status'    => $this->request->getPost('status'),
        ];

        $userModel->update($id_u, $data);
        return redirect()->to('/admin/dataPelanggan')->with('success', 'Data pelanggan berhasil diubah!');
    }

    public function deletePelanggan($id_u)
    {
        $userModel = new UserModel();
        $userModel->delete($id_u);
        return redirect()->to('/admin/dataPelanggan')->with('success', 'Data pelanggan berhasil dihapus!');
    }

    public function stok()
    {
        $stokModel = new StokModel();
        $data['stok'] = $stokModel->findAll();
        return view('admin/forms/stok', $data);
    }

    public function inputStok()
    {
        $KategoriModel = new KategoriModel();
        $data['ktg'] = $KategoriModel->findAll();
        return view('admin/forms/inputStok', $data);
    }

    public function saveStok()
    {
        $stokModel = new StokModel();

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/', $namaGambar);

        $data = [
            'id_ktg' => $this->request->getPost('id_ktg'),
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'gambar' => $namaGambar,
        ];

        $stokModel->insert($data);
        return redirect()->to('/admin/inputStok')->with('success', 'Data berhasil disimpan!');
    }

    public function dataStok()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('stok');
        $builder->select('stok.*, kategori.kategori');
        $builder->join('kategori', 'kategori.id_ktg = stok.id_ktg');
        $query = $builder->get();

        $data['stoks'] = $query->getResultArray();

        return view('admin/tables/dataStok', $data);
    }
    public function editStok($id)
    {
        $KategoriModel = new KategoriModel();
        $data['ktg'] = $KategoriModel->findAll();
        $stokModel = new StokModel();
        $data['stok'] = $stokModel->find($id);
        return view('/admin/forms/editStok', $data);
    }


    public function updateStok($id)
    {
        $stokModel = new stokModel();

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/', $namaGambar);

        $data = [
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'gambar'      => $namaGambar,
            'id_ktg' => $this->request->getPost('id_ktg'),

        ];

        $stokModel->update($id, $data);
        return redirect()->to('/admin/dataStok')->with('success', 'Data stok berhasil diubah!');
    }

    public function deleteStok($id)
    {
        $stokModel = new StokModel();
        $stokModel->delete($id);
        return redirect()->to('/admin/dataStok')->with('success', 'Data stok berhasil dihapus!');
    }

    public function statusUser($id_u)
    {
        $userModel = new UserModel();

        $data = [
            'status' => 'Aktif'
        ];

        $userModel->update($id_u, $data);
        return redirect()->to('/admin/dataPelanggan')->with('success', 'Akun berhasil diaktifkan!');
    }

    public function inputKategori()
    {
        return view('admin/forms/inputKategori');
    }

    public function saveKategori()
    {
        $KategoriModel = new KategoriModel();

        $data = [
            'kategori' => $this->request->getPost('kategori'),
        ];

        $KategoriModel->insert($data);
        return redirect()->to('/admin/inputKategori')->with('success', 'Data berhasil disimpan!');
    }

    public function dataKategori()
    {

        $KategoriModel = new KategoriModel();
        $data['ktg'] = $KategoriModel->findAll();

        return view('admin/tables/dataKategori', $data);
    }
    public function editKategori($id_ktg)
    {
        $KategoriModel = new KategoriModel();
        $data['kategori'] = $KategoriModel->find($id_ktg);
        return view('/admin/forms/editKategori', $data);
    }

    public function updateKategori($id_ktg)
    {
        $KategoriModel = new KategoriModel();

        $data = [
            'kategori' => $this->request->getPost('kategori'),

        ];

        $KategoriModel->update($id_ktg, $data);
        return redirect()->to('/admin/dataKategori')->with('success', 'Data kategori berhasil diubah!');
    }

    public function deleteKategori($id_ktg)
    {
        $KategoriModel = new KategoriModel();
        $KategoriModel->delete($id_ktg);
        return redirect()->to('/admin/dataKategori')->with('success', 'Data kategori berhasil dihapus!');
    }
}
