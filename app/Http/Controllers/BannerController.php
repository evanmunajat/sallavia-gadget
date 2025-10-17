<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Menampilkan semua banner
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('banners.index', compact('banners'));
    }

    // Form tambah banner baru
    public function create()
    {
        return view('banners.create');
    }

    // Simpan banner baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    // Form edit banner
    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    // Update banner
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Jika ada file baru, hapus gambar lama lalu simpan yang baru
        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    // Hapus banner
    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus.');
    }
}
