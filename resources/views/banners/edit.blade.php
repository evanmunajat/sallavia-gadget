<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Banner') }}
            </h2>
            <a href="{{ route('banners.index') }}" 
               class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow transition">
               <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Banner</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Subjudul -->
                <div class="mb-4">
                    <label for="subtitle" class="block text-gray-700 font-semibold mb-2">Subjudul</label>
                    <textarea name="subtitle" id="subtitle" rows="3"
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('subtitle', $banner->subtitle) }}</textarea>
                </div>

                <!-- Teks Tombol -->
                <div class="mb-4">
                    <label for="button_text" class="block text-gray-700 font-semibold mb-2">Teks Tombol</label>
                    <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $banner->button_text) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Link Tombol -->
                <div class="mb-4">
                    <label for="button_link" class="block text-gray-700 font-semibold mb-2">Link Tombol</label>
                    <input type="text" name="button_link" id="button_link" value="{{ old('button_link', $banner->button_link) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Gambar -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold mb-2">Gambar Banner</label>
                    <input type="file" name="image" id="image" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">

                    @if ($banner->image)
                        <div class="mt-3">
                            <p class="text-gray-500 text-sm mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $banner->image) }}" 
                                 alt="Banner Image" 
                                 class="w-64 rounded-lg shadow">
                        </div>
                    @endif
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end mt-6">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
