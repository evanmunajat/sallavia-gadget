<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        Tambah Banners
      </h2>
      <a href="{{ route('banners.index') }}" 
         class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium shadow transition">
         ← Kembali
      </a>
    </div>
  </x-slot>

  <div class="container mx-auto py-10 px-4">
    <div class="bg-white p-6 rounded-lg shadow">
      <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Judul</label>
          <input type="text" name="title" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Subjudul</label>
          <input type="text" name="subtitle" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Teks Tombol</label>
          <input type="text" name="button_text" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Link Tombol</label>
          <input type="text" name="button_link" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 mb-2">Gambar Banner</label>
          <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="flex justify-end">
          <a href="{{ route('banners.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg mr-2">Kembali</a>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
