<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function beranda(): string
    {
        return view('pages/beranda');
    }
    public function tentang(): string
    {
        return view('pages/tentang');
    }
    public function galeri(): string
    {
        return view('pages/galeri');
    }

    public function layanan(): string
    {
        return view('pages/layanan');
    }

    public function kontak(): string
    {
        return view('pages/kontak');
    }

    public function unauth(): string
    {
        return view('pages/unauth');
    }
}
