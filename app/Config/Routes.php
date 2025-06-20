<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::beranda');

$routes->get('/tentang', 'Home::tentang');

$routes->get('/galeri', 'Home::galeri');

$routes->get('/layanan', 'Home::layanan');

$routes->get('/kontak', 'Home::kontak');

$routes->post('/keranjang/simpanDataDiri', 'Keranjang::simpanDataDiri');
// $routes->get('/keranjang', 'Keranjang::index');
$routes->post('/keranjang/tambah', 'Keranjang::tambah');
$routes->get('/keranjang/hapus/(:num)', 'Keranjang::hapus/$1');

$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

$routes->get('/register', 'Login::register');
$routes->post('/login/saveRegister', 'Login::saveRegister');

$routes->get('/loginAdmin', 'Login::loginAdmin');
$routes->post('/loginAdmin/process', 'Login::processAdmin');
$routes->get('/logout', 'Login::logout');

$routes->get('/registerAdmin', 'Login::registerAdmin');
$routes->post('/loginAdmin/saveRegister', 'Login::saveRegisterAdmin');

$routes->get('/checkout', 'Keranjang::checkout');
$routes->post('/keranjang/bayar', 'Keranjang::bayar');

$routes->get('/pemesanan', 'Pemesanan::index');

// $routes->get('/admin', 'Admin::index');
// $routes->get('/admin/inputAdmin', 'Admin::inputAdmin');
// $routes->get('/admin/inputPelanggan', 'Admin::inputPelanggan');
// $routes->get('/admin/dataAdmin', 'Admin::dataAdmin');
// $routes->get('/admin/dataPelanggan', 'Admin::dataPelanggan');
$routes->get('/logoutAdmin', 'Login::logoutAdmin');

$routes->post('/admin/saveStok', 'Admin::saveStok');
$routes->post('/admin/saveAdmin', 'Admin::saveAdmin');
$routes->get('/admin/statusUser/(:num)', 'Admin::statusUser/$1');
$routes->post('/admin/savePelanggan', 'Admin::savePelanggan');
$routes->post('/admin/saveKategori', 'Admin::saveKategori');

$routes->get('/admin/editAdmin/(:num)', 'Admin::editAdmin/$1');
$routes->post('/admin/updateAdmin/(:num)', 'Admin::updateAdmin/$1');
$routes->get('/admin/deleteAdmin/(:num)', 'Admin::deleteAdmin/$1');

$routes->get('/admin/editPelanggan/(:num)', 'Admin::editPelanggan/$1');
$routes->post('/admin/updatePelanggan/(:num)', 'Admin::updatePelanggan/$1');
$routes->get('/admin/deletePelanggan/(:num)', 'Admin::deletePelanggan/$1');

$routes->get('/keranjang/editPelanggan/(:num)', 'Keranjang::editPelanggan/$1');
$routes->post('/keranjang/updatePelanggan/(:num)', 'Keranjang::updatePelanggan/$1');

$routes->get('/admin/editKategori/(:num)', 'Admin::editKategori/$1');
$routes->post('/admin/updateKategori/(:num)', 'Admin::updateKategori/$1');
$routes->get('/admin/deleteKategori/(:num)', 'Admin::deleteKategori/$1');

$routes->get('/admin/dataTransaksi', 'Transaksi::dataTransaksi');
$routes->get('/admin/editTransaksi/(:num)', 'Transaksi::editTransaksi/$1');
$routes->post('/admin/updateTransaksi/(:num)', 'Transaksi::updateTransaksi/$1');
$routes->get('/admin/deleteTransaksi/(:num)', 'Transaksi::deleteTransaksi/$1');

$routes->post('/pesanan/diterima/(:num)', 'Pemesanan::diterima/$1');

$routes->group('', ['filter' => 'admin:admin'], function ($routes) {
    $routes->get('/admin', 'Admin::index');
    $routes->get('/admin/inputAdmin', 'Admin::inputAdmin');
    $routes->get('/admin/inputPelanggan', 'Admin::inputPelanggan');
    $routes->get('/admin/inputKategori', 'Admin::inputKategori');
    $routes->get('/admin/dataAdmin', 'Admin::dataAdmin');
    $routes->get('/admin/dataPelanggan', 'Admin::dataPelanggan');
    $routes->get('/admin/dataTransaksi', 'Transaksi::dataTransaksi');
    $routes->get('/admin/dataRiwayat', 'Transaksi::riwayatTransaksi');
    $routes->get('/admin/dataKategori', 'Admin::dataKategori');
    $routes->get('/admin/inputStok', 'Admin::inputStok');
    $routes->get('/admin/dataStok', 'Admin::dataStok');
});

$routes->group('', ['filter' => 'user:user'], function ($routes) {
    $routes->get('/keranjang', 'Keranjang::index');
    $routes->post('/keranjang/bayar', 'Keranjang::bayar');
    $routes->get('/pemesanan', 'Pemesanan::index');
});

$routes->get('/admin/stok', 'Admin::stok');
$routes->post('/admin/stok/update', 'Admin::updateStok');

$routes->get('/admin/editStok/(:num)', 'Admin::editStok/$1');
$routes->post('/admin/updateStok/(:num)', 'Admin::updateStok/$1');
$routes->get('/admin/deleteStok/(:num)', 'Admin::deleteStok/$1');

$routes->get('/unauth', 'Home::unauth');

$routes->get('/keranjang/token', 'Keranjang::token');
$routes->post('/keranjang/notification', 'Keranjang::notification');

$routes->get('/transaksi/cetakPdf', 'Transaksi::cetakPdf');
