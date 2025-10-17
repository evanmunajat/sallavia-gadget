<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ===== FRONTEND =====
    public function frontendIndex()
    {
        $products = Product::latest()->get();
        return view('frontend.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Ambil gambar utama: dari kolom image atau relasi is_main
        $mainImage = $product->images->firstWhere('is_main', true) 
                     ?? ($product->images->first() ?: null);

        // Produk lain untuk rekomendasi
        $related = Product::where('id', '!=', $product->id)
                          ->latest()
                          ->take(6)
                          ->get();

        return view('frontend.show', compact('product', 'mainImage', 'related'));
    }

    // ===== BACKEND =====
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('products.edit', compact('product'));
    }

    /** ✅ Simpan data baru */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'description'    => 'nullable|string',
            'condition'      => 'required|in:new,second,refurbished',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specifications' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'price', 'description', 'condition']);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Encode spesifikasi jadi JSON
        if ($request->has('specifications')) {
            $data['specifications'] = json_encode($request->specifications);
        }

        // Simpan produk
        $product = Product::create($data);

        // Simpan gambar utama ke relasi dengan flag is_main
        if ($request->hasFile('image')) {
            $product->images()->create([
                'image' => $data['image'],
                'is_main' => true,
            ]);
        }

        // Upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                $product->images()->create([
                    'image' => $path,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /** ✅ Update data */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'condition' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'specifications' => 'nullable|array',
        ]);

        // Encode spesifikasi JSON
        $data['specifications'] = isset($data['specifications']) 
                                 ? json_encode($data['specifications']) 
                                 : json_encode([]);

        // Update data produk
        $product->update($data);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            // Hapus gambar lama
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $product->update(['image' => $path]);

            // Update relasi gambar utama
            $main = $product->images()->where('is_main', true)->first();
            if ($main) {
                $main->update(['image' => $path]);
            } else {
                $product->images()->create([
                    'image' => $path,
                    'is_main' => true,
                ]);
            }
        }

        // Upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $product->images()->create([
                    'image' => $path,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    // ===== DELETE PRODUK =====
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Hapus gambar utama
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus semua gambar tambahan
        foreach ($product->images as $img) {
            if ($img->image && Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    // ===== DELETE GAMBAR TAMBAHAN (AJAX) =====
    public function destroyImage($id)
{
    $image = ProductImage::findOrFail($id);
    $product = $image->product;

    if ($image->is_main) {
        $fallback = $product->images()->where('id', '!=', $image->id)->first();
        if ($fallback) {
            $fallback->update(['is_main' => true]);
            $product->update(['image' => $fallback->image]);
        } else {
            $product->update(['image' => null]);
        }
    }

    if ($image->image && Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json(['success' => true]); // pastikan return ini
    }
}
