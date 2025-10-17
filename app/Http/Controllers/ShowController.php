<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        // Kalau lo mau list produk di halaman utama
        $products = Product::latest()->get();
        return view('products.index', compact('products', 'newarrivals'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $newarrivals = Product::where('id', '!=', $id)->latest()->take(6)->get();
        return view('frontend.show', compact('product', 'newarrivals'));
    }


}
