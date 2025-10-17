<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
     Tambah Aksesoris
    </h2>
  </x-slot>

  <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Nama Aksesoris</label>
          <input type="text" name="name" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Deskripsi</label>
          <textarea name="description" class="w-full border-gray-300 rounded-lg"></textarea>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Harga</label>
          <input type="number" name="price" class="w-full border-gray-300 rounded-lg" required>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Kategori</label>
          <input type="text" name="category" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Gambar Produk</label>
          <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="flex justify-end">
          <a href="{{ route('products.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2">Kembali</a>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
