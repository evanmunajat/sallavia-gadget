<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Edit Produk / Promo Unggulan
    </h2>
  </x-slot>

  <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">

      <form action="{{ route('promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Kondisi Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Kondisi Produk <span class="text-red-500">*</span></label>
          <div class="flex gap-6">
              <div class="flex items-center">
                  <input type="radio" name="condition" id="new" value="new" 
                         class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                         {{ old('condition', $promo->condition) == 'new' ? 'checked' : '' }} required>
                  <label for="new" class="ml-2 text-gray-700 font-medium">New</label>
              </div>
              <div class="flex items-center">
                  <input type="radio" name="condition" id="second" value="second" 
                         class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded"
                         {{ old('condition', $promo->condition) == 'second' ? 'checked' : '' }}>
                  <label for="second" class="ml-2 text-gray-700 font-medium">Second</label>
              </div>
          </div>
        </div>

        {{-- Nama Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Nama Produk <span class="text-red-500">*</span></label>
          <input type="text" name="name" 
                 class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" 
                 value="{{ old('name', $promo->name) }}" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Deskripsi</label>
          <textarea name="description" rows="4" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400">{{ old('description', $promo->description) }}</textarea>
        </div>

        {{-- Harga --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Harga <span class="text-red-500">*</span></label>
          <input type="number" name="price" 
                 class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400" 
                 value="{{ old('price', $promo->price) }}" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Kategori</label>
          <input type="text" name="category" 
                 class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400"
                 value="{{ old('category', $promo->category) }}">
        </div>

        {{-- Gambar Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Gambar Produk</label>
          @if($promo->image)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->name }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
          @endif
          <input type="file" name="image" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end">
          <a href="{{ route('promo.index') }}" 
             class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2 hover:bg-gray-400 transition">Kembali</a>
          <button type="submit" 
                  class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Perubahan
          </button>
        </div>

      </form>
    </div>
  </div>
</x-app-layout>
