<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}
      </h2>
      <div class="flex gap-3">
        <a href="{{ route('products.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
          Kembali
        </a>
        <button type="submit" form="productForm"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
          Simpan Produk
        </button>
      </div>
    </div>
  </x-slot>

  <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">

      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

      <form id="productForm" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
            method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        {{-- Nama Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Nama Produk <span class="text-red-500">*</span></label>
          <input type="text" name="name"
                 value="{{ old('name', $product->name ?? '') }}"
                 placeholder="Masukkan nama produk"
                 class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Kondisi Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-2">Kondisi Produk <span class="text-red-500">*</span></label>
          <div class="flex gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="condition" value="new"
                     class="text-blue-600 focus:ring-blue-500"
                     {{ old('condition', $product->condition ?? '') == 'new' ? 'checked' : '' }} required>
              <span class="text-gray-700 font-medium">New</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="radio" name="condition" value="second"
                     class="text-yellow-600 focus:ring-yellow-500"
                     {{ old('condition', $product->condition ?? '') == 'second' ? 'checked' : '' }}>
              <span class="text-gray-700 font-medium">Second</span>
            </label>
          </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Deskripsi Produk</label>
          <textarea name="description" rows="5"
                    placeholder="Masukkan deskripsi produk"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $product->description ?? '') }}</textarea>
        </div>

        {{-- Harga --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Harga <span class="text-red-500">*</span></label>
          <input type="number" name="price"
                 value="{{ old('price', $product->price ?? '') }}"
                 placeholder="Masukkan harga produk"
                 class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Spesifikasi Dinamis --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Spesifikasi Produk</label>
          <div id="specifications-wrapper" class="space-y-2">
            @php
              $specs = old('specifications', $product->specifications ?? [['key' => '', 'value' => '']]);
            @endphp
            @foreach($specs as $i => $spec)
              <div class="flex gap-2">
                <input type="text" name="specifications[{{ $i }}][key]" value="{{ $spec['key'] ?? '' }}"
                       placeholder="Nama spesifikasi"
                       class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                <input type="text" name="specifications[{{ $i }}][value]" value="{{ $spec['value'] ?? '' }}"
                       placeholder="Nilai spesifikasi"
                       class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                <button type="button" onclick="removeSpec(this)" class="text-red-500 font-bold">×</button>
              </div>
            @endforeach
          </div>
          <button type="button" onclick="addSpec()"
                  class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Tambah Spesifikasi
          </button>
        </div>

        {{-- Gambar Utama --}}
        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-1">Gambar Utama Dashboard</label>
          <input type="file" name="image" accept="image/*"
                 class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
          @if(isset($product) && $product->image)
            <div class="mt-3 relative inline-block">
              <img src="{{ asset('storage/' . $product->image) }}" class="w-40 h-40 object-cover rounded-lg shadow">
            </div>
          @endif
        </div>

        {{-- Gambar Tambahan --}}
        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-1">Gambar Tambahan (upload satu per satu)</label>
          <div id="imageInputs">
            <div class="flex items-center gap-3 mb-3">
              <input type="file" name="images[]" accept="image/*"
                     class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
              <button type="button" onclick="addImageInput()"
                      class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">+</button>
            </div>
          </div>

          {{-- Preview gambar tambahan --}}
          @if(isset($product) && $product->images->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-3">
              @foreach($product->images as $img)
                <div class="relative flex flex-col items-center group">
                  <img src="{{ asset('storage/'.$img->image) }}" class="w-full h-32 object-cover rounded-lg shadow mb-2">
                  <button type="button"
                          onclick="deleteImage({{ $img->id }})"
                          class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                    Hapus
                  </button>
                </div>
              @endforeach
            </div>
          @endif
        </div>

      </form>
    </div>
  </div>

  <script>
    function addImageInput() {
      const container = document.getElementById('imageInputs');
      const div = document.createElement('div');
      div.classList.add('flex','items-center','gap-3','mb-3');
      div.innerHTML = `
        <input type="file" name="images[]" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">-</button>
      `;
      container.appendChild(div);
    }

    function deleteImage(imageId) {
      if (!confirm('Yakin hapus gambar ini?')) return;
      fetch(`/products/images/${imageId}`, {
        method: 'DELETE',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
      }).then(res => res.ok ? location.reload() : alert('Gagal hapus gambar!'))
      .catch(()=> alert('Terjadi kesalahan.'));
    }

    function addSpec() {
      const wrapper = document.getElementById('specifications-wrapper');
      const index = wrapper.children.length;
      const div = document.createElement('div');
      div.classList.add('flex','gap-2');
      div.innerHTML = `
        <input type="text" name="specifications[${index}][key]" placeholder="Nama spesifikasi" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
        <input type="text" name="specifications[${index}][value]" placeholder="Nilai spesifikasi" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
        <button type="button" onclick="removeSpec(this)" class="text-red-500 font-bold">×</button>
      `;
      wrapper.appendChild(div);
    }

    function removeSpec(btn){ btn.closest('div').remove(); }
  </script>
</x-app-layout>
