<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(10);
        return view('promo.index', compact('promos'));
    }

    public function create()
    {
        return view('promo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'condition' => 'required|in:new,second',
            // 'is_promo' => 'nullable|boolean',
            // 'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promos', 'public');
        }

        $data['is_promo'] = $request->has('is_promo');
        $data['is_featured'] = $request->has('is_featured');

        Promo::create($data);

        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit(Promo $promo)
    {
        return view('promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'condition' => 'required|in:new,second',
            // 'is_promo' => 'nullable|boolean',
            // 'is_featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promos', 'public');
        }

        $data['is_promo'] = $request->has('is_promo');
        $data['is_featured'] = $request->has('is_featured');

        $promo->update($data);

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus!');
    }
}
