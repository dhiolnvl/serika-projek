<?php

namespace App\Controllers;

class Pemesanan extends BaseController
{
    // public function index()
    // {
    //     $id_user = session()->get('id_u');
    //     if (!$id_user) {
    //         return redirect()->to('/login')->with('error', 'Silakan login dulu.');
    //     }

    //     $pemesananModel = new PemesananModel();
    //     $detailModel = new DetailModel();

    //     $pemesanan = $pemesananModel->where('id_u', $id_user)->findAll();

    //     foreach ($pemesanan as &$p) {
    //         $p['detail'] = $detailModel->where('id_p', $p['id_p'])->findAll();
    //     }

    //     return view('pemesanan/index', ['pemesanan' => $pemesanan]);
    // }
    public function index()
    {
        $id_user = session()->get('id_u');
        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        $pemesananModel = new \App\Models\PemesananModel();
        $detailModel = new \App\Models\DetailModel();

        $pemesanan = $pemesananModel->where('id_u', $id_user)->findAll();     

        foreach ($pemesanan as &$p) {
            $details = $detailModel->where('id_p', $p['id_p'])->findAll();
            $p['detail'] = $details;
            $p['status'] = $details[0]['status'] ?? '-';
        }

        return view('pemesanan/index', ['pemesanan' => $pemesanan]);
    }

    public function diterima($id_p)
{
    $db = \Config\Database::connect();
    $db->table('pemesanan_detail')->where('id_p', $id_p)->update([
        'status' => 'Selesai'
    ]);

    return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi sebagai diterima.');
}
}
