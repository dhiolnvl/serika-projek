<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PemesananModel;
use App\Models\UserModel;
use App\Models\StokModel;

class Admin extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_a');
        if (!$id_user) {
            return redirect()->to('/loginAdmin');
        }

        $userModel = new UserModel();
        $jumlahUser = $userModel->countAll();

        $db = \Config\Database::connect();
        $now = time();

        $onlineUser = $db->table('online_users')
            ->where('last_activity >=', $now - 300)
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
            ->selectSum('harga')
            ->where('status', 'Selesai')
            ->get()
            ->getRow()
            ->harga;

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

        $query = $builder
            ->groupBy('pemesanan.id_p')
            ->orderBy('pemesanan.id_p', 'DESC')
            ->get();

        $data['transaksi'] = $query->getResultArray();


        return view('admin/dashboard', array_merge([
            'jumlahUser'     => $jumlahUser,
            'onlineUser'     => $onlineUser,
            'pesananBaru'    => $pesananBaru,
            'pesananSelesai' => $pesananSelesai,
            'totalSelesai'   => $totalSelesai,
        ], $data));
    }

    public function inputAdmin()
    {
        $id_user = session()->get('id_a');

        return view('admin/forms/inputAdmin');
    }

    public function inputPelanggan()
    {
        $id_user = session()->get('id_a');

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
        return view('admin/forms/inputStok');
    }

    public function saveStok()
    {
        $stokModel = new StokModel();

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads/', $namaGambar);

        $data = [
            'jenis' => $this->request->getPost('jenis'),
            'stok' => $this->request->getPost('stok'),
            'gambar'      => $namaGambar

        ];

        $stokModel->insert($data);
        return redirect()->to('/admin/inputPelanggan')->with('success', 'Data berhasil disimpan!');
    }

    public function dataStok()
    {

        $StokModel = new StokModel();
        $data['stoks'] = $StokModel->findAll();

        return view('admin/tables/dataStok', $data);
    }
    public function editStok($id)
    {
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
            'gambar'      => $namaGambar

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
}
