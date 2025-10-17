<?php

namespace App\Http\Controllers;

use App\Models\NewArrival;
use App\Models\NewArrivalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewArrivalController extends Controller
{
    /** ✅ Tampilkan semua data */
    public function index()
    {
        $newarrivals = NewArrival::latest()->get();
        return view('newarrival.index', compact('newarrivals'));
    }

    /** ✅ Tampilkan detail satu produk */
    public function show($id)
    {
        $newarrival = NewArrival::with('images')->findOrFail($id);

        // Ambil gambar utama
        $mainImage = $newarrival->images->firstWhere('is_main', true)
            ?? ($newarrival->images->first() ?: null);

        // Produk lain (opsional)
        $related = NewArrival::where('id', '!=', $newarrival->id)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.show-newarrival', compact('newarrival', 'mainImage', 'related'));
    }

    /** ✅ Form tambah */
    public function create()
    {
        return view('newarrival.create');
    }

    /** ✅ Simpan data baru */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric',
            'description'    => 'nullable|string',
            'condition'      => 'required|in:new,second,refurbished',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'specifications' => 'nullable|array',
        ]);

        $data = $request->only(['name', 'price', 'description', 'condition']);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('new_arrivals', 'public');
        }

        // Encode spesifikasi
        if ($request->has('specifications')) {
            $data['specifications'] = json_encode($request->specifications);
        }

        // Simpan produk
        $newarrival = NewArrival::create($data);

        // Simpan gambar utama ke relasi
        if ($request->hasFile('image')) {
            $newarrival->images()->create([
                'image' => $data['image'],
                'is_main' => true,
            ]);
        }

        // Upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('new_arrivals', 'public');
                $newarrival->images()->create([
                    'image' => $path,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()->route('newarrival.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /** ✅ Form edit */
    public function edit(NewArrival $newarrival)
    {
        $newarrival->load('images');
        return view('newarrival.edit', compact('newarrival'));
    }

    /** ✅ Update data */
    public function update(Request $request, NewArrival $newarrival)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'condition' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'nullable|string',
            'specifications.*.value' => 'nullable|string',
        ]);

        // Update produk
        $newarrival->update([
            'name' => $data['name'],
            'condition' => $data['condition'],
            'description' => $data['description'],
            'price' => $data['price'],
            'specifications' => json_encode($data['specifications'] ?? []),
        ]);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('new_arrivals', 'public');

            // Hapus gambar lama jika ada
            if ($newarrival->image) {
                Storage::disk('public')->delete($newarrival->image);
            }

            $newarrival->update(['image' => $path]);

            // Update relasi utama
            $main = $newarrival->images()->where('is_main', true)->first();
            if ($main) {
                $main->update(['image' => $path]);
            } else {
                $newarrival->images()->create([
                    'image' => $path,
                    'is_main' => true,
                ]);
            }
        }

        // Upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('new_arrivals', 'public');
                $newarrival->images()->create(['image' => $path, 'is_main' => false]);
            }
        }

        return redirect()->route('newarrival.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /** ✅ Hapus produk beserta semua gambar */
    public function destroy(NewArrival $newarrival)
    {
        // Hapus gambar utama
        if ($newarrival->image) {
            Storage::disk('public')->delete($newarrival->image);
        }

        // Hapus semua gambar tambahan
        foreach ($newarrival->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $newarrival->delete();

        return redirect()->route('newarrival.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    /** ✅ Hapus 1 gambar (utama / tambahan) via AJAX */
    public function destroyImage($id)
    {
        $image = NewArrivalImage::findOrFail($id);

        // Hapus file fisik
        if($image->image && Storage::disk('public')->exists($image->image)){
            Storage::disk('public')->delete($image->image);
        }

        $newarrival = $image->newarrival;

        // Jika gambar utama, update fallback
        if($image->is_main){
            $newarrival->update(['image' => null]);
            $fallback = $newarrival->images()->where('id','!=',$image->id)->first();
            if($fallback){
                $fallback->update(['is_main' => true]);
                $newarrival->update(['image' => $fallback->image]);
            }
        }

        $image->delete();

        // Kembali response JSON agar JS bisa hapus tanpa refresh
        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus!'
        ]);
    }
}
