<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TentangKamiController extends Controller
{
    // Fungsi untuk menampilkan halaman About
    public function index()
    {
        return view('frontend.tentangkami.index'); // pastikan file ada di resources/views/frontend/tentangkami/index.blade.php
    }
}
