<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\NewArrival; // import model NewArrival
use App\Models\Promo;      // import model Promo

class ProdukController extends Controller
{
    public function index()
    {
        // Ambil data terbaru 8 item
        $products    = Product::latest()->take(8)->get();
        $newarrivals = NewArrival::latest()->take(8)->get();
        $promos      = Promo::latest()->take(8)->get();

        // Kirim ke view frontend.produk.produk
        return view('frontend.produk.produk', compact('products', 'newarrivals', 'promos'));
    }
}
