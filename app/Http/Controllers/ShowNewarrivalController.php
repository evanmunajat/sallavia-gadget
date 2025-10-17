<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowNewarrivalController extends Controller
{
    public function index()
    {
        // Kalau lo mau list produk di halaman utama
        $newarrivals = Product::latest()->get();
         return view('frontend.show-newarrival', compact('newarrival', 'related'));
    }

   public function show($id)
{
    $newarrival = \App\Models\NewArrival::with('images')->findOrFail($id);

    // Ambil gambar utama (kalau ada yg is_main = true)
    $mainImage = $newarrival->images->firstWhere('is_main', true) ?? $newarrival->images->first();

    // Produk terkait (opsional)
    $related = \App\Models\NewArrival::where('id', '!=', $id)
        ->latest()
        ->take(4)
        ->get();

    return view('frontend.show-newarrival', compact('newarrival', 'mainImage', 'related'));
}



}
