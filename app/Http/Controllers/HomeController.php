<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Banner;
use App\Models\NewArrival;
use Illuminate\Http\Request;
use App\Models\Promo; // pastikan ada model Promo

class HomeController extends Controller
{
    public function index()
    {
        $heroBanner   = Banner::latest()->first();
        $products     = Product::latest()->take(8)->get();
        $newarrivals  = NewArrival::latest()->take(8)->get();
        $promos       = Promo::latest()->take(8)->get(); // ambil data promo dari tabel promos

        return view('frontend.home', compact('heroBanner', 'products', 'newarrivals', 'promos'));
    }
}

