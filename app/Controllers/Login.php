<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;

class Login extends BaseController
{
    public function __construct()
    {
        helper(['form']);
    }

    // Menampilkan form login
    public function index()
    {
        return view('auth/login');
    }

    // Proses login
    public function process()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Username dan password harus diisi.');
        }

        $user = $userModel->where('username', $username)->first();

        if ($user) {

            if ($user['status'] !== 'Aktif') {
                return redirect()->to('/login')->with('error', 'Akun Anda belum diaktifkan oleh admin.');
            }


            if (password_verify($password, $user['password'])) {

                session()->set([
                    'id_u' => $user['id_u'],
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                    'role' => $user['role']
                ]);
                return redirect()->to('/keranjang');
            } else {
                return redirect()->to('/login')->with('error', 'Password salah!');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Username tidak ditemukan!');
        }
    }


    // Proses logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }

    // Menampilkan form registrasi
    public function register()
    {
        return view('auth/register');
    }

    // Menyimpan data registrasi
    public function saveRegister()
    {
        $userModel = new UserModel();

        // Validasi input
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status'    => 'Nonaktif',
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function loginAdmin()
    {
        return view('admin/authAdmin/login');
    }
    public function registerAdmin()
    {
        return view('admin/authAdmin/register');
    }

    public function processAdmin()
    {
        $adminModel = new AdminModel();

        // Ambil dan bersihkan input
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        // Validasi input kosong
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Username dan password harus diisi.');
        }

        // Cari user berdasarkan username
        $user = $adminModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                session()->set([
                    'id_a' => $user['id_a'],
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                    'role'       => $user['role'],
                ]);

                return redirect()->to('/admin');
            } else {
                return redirect()->to('/loginAdmin')->withInput()->with('error', 'Password salah!');
            }
        } else {
            return redirect()->to('/loginAdmin')->withInput()->with('error', 'Username tidak ditemukan!');
        }
    }


    public function saveRegisterAdmin()
    {
        $adminModel = new AdminModel();

        // Validasi input
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $adminModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $password,
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
        ]);

        return redirect()->to('/loginAdmin')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logoutAdmin()
    {
        session()->destroy();
        return redirect()->to('/loginAdmin')->with('success', 'Berhasil logout.');
    }
}
