<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center justify-between">
      Edit Produk New Arrival
      <div class="flex gap-3">
        <a href="{{ route('newarrival.index') }}"
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
          Kembali
        </a>
        <button type="submit" form="newarrivalForm"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
          Simpan Perubahan
        </button>
      </div>
    </h2>
  </x-slot>

  <div class="py-10 max-w-4xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow">

      {{-- Pesan sukses --}}
      @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

      {{-- FORM --}}
      <form id="newarrivalForm"
            action="{{ route('newarrival.update', $newarrival->id) }}"
            method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">
            Nama Produk <span class="text-red-500">*</span>
          </label>
          <input type="text" name="name"
                 value="{{ old('name', $newarrival->name) }}"
                 class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

       {{-- Kondisi Produk --}}
<div class="mb-4">
  <label class="block text-gray-700 font-medium mb-2">
    Kondisi Produk <span class="text-red-500">*</span>
  </label>
  <div class="flex gap-6">
    @foreach(['new'=>'New','second'=>'Second'] as $key => $label)
    <label class="flex items-center gap-2 cursor-pointer">
      <input type="radio" name="condition" value="{{ $key }}"
             class="text-blue-600 focus:ring-blue-500"
             {{ old('condition', $newarrival->condition) == $key ? 'checked' : '' }} required>
      <span class="text-gray-700 font-medium">{{ $label }}</span>
    </label>
    @endforeach
  </div>
</div>


        {{-- Deskripsi --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Deskripsi Produk</label>
          <textarea name="description" rows="5"
                    class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">{{ old('description', $newarrival->description) }}</textarea>
        </div>

        {{-- Harga --}}
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">
            Harga <span class="text-red-500">*</span>
          </label>
          <input type="number" name="price"
                 value="{{ old('price', $newarrival->price) }}"
                 class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Spesifikasi Dinamis --}}
        <div class="mb-4">
          <label class="block text-gray-700 mb-2 font-medium">Spesifikasi Produk</label>

          @php
              $specs = [];
              if (isset($newarrival) && $newarrival->specifications) {
                  $specs = is_string($newarrival->specifications)
                      ? json_decode($newarrival->specifications, true)
                      : $newarrival->specifications;
                  $specs = is_array($specs) ? $specs : [];
              }
          @endphp

          <div id="specifications-wrapper" class="space-y-2">
              @if(!empty($specs))
                  @foreach($specs as $index => $spec)
                      <div class="flex gap-2">
                          <input type="text" name="specifications[{{ $index }}][key]" value="{{ $spec['key'] ?? '' }}" placeholder="Nama spesifikasi" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                          <input type="text" name="specifications[{{ $index }}][value]" value="{{ $spec['value'] ?? '' }}" placeholder="Nilai" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                          <button type="button" onclick="removeSpec(this)" class="text-red-500 font-bold">×</button>
                      </div>
                  @endforeach
              @else
                  <div class="flex gap-2">
                      <input type="text" name="specifications[0][key]" placeholder="Nama spesifikasi" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                      <input type="text" name="specifications[0][value]" placeholder="Nilai" class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
                      <button type="button" onclick="removeSpec(this)" class="text-red-500 font-bold">×</button>
                  </div>
              @endif
          </div>

          <button type="button" onclick="addSpec()" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tambah Spesifikasi</button>
        </div>

        {{-- Gambar Utama --}}
        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-1">Gambar Utama Dashboard</label>
          <input type="file" name="image" accept="image/*"
                 class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
          @if($newarrival->image)
            <div class="mt-3">
              <img src="{{ asset('storage/' . $newarrival->image) }}" class="w-48 h-48 object-cover rounded-lg shadow">
            </div>
          @endif
        </div>

        {{-- Gambar Tambahan --}}
        <div class="mb-6">
          <label class="block text-gray-700 font-medium mb-1">Gambar Tambahan (upload satu per satu)</label>

          {{-- Input Upload Dinamis --}}
          <div id="imageInputs" class="mb-3">
            <div class="flex items-center gap-3 mb-3">
              <input type="file" name="images[]" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
              <button type="button" onclick="addImageInput()" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded">+</button>
            </div>
          </div>

          {{-- Tampilkan Gambar Tambahan --}}
          @if($newarrival->images && $newarrival->images->count())
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-3">
              @foreach($newarrival->images as $img)
                <div class="relative flex flex-col items-center" data-id="{{ $img->id }}">
                  <img src="{{ asset('storage/'.$img->image) }}" class="w-full h-32 object-cover rounded-lg shadow mb-2">
                  {{-- Tombol hapus selalu muncul, tanpa hover --}}
                  <button type="button"
                    onclick="deleteImage({{ $img->id }}, this)"
                    class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded">
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

  {{-- Script dinamis --}}
  <script>
    // Tambah input gambar baru
    function addImageInput() {
      const container = document.getElementById('imageInputs');
      const div = document.createElement('div');
      div.classList.add('flex', 'items-center', 'gap-3', 'mb-3');
      div.innerHTML = `
        <input type="file" name="images[]" accept="image/*"
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="this.parentElement.remove()"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">-</button>
      `;
      container.appendChild(div);
    }

    // Hapus gambar tambahan via AJAX, DOM langsung update
   function deleteImage(imageId, el) {
    if(!confirm('Yakin ingin menghapus gambar ini?')) return;

    fetch(`/newarrival/images/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            // Hapus elemen dari DOM
            const parentDiv = el.closest('[data-id]');
            if(parentDiv) parentDiv.remove();

            // ✨ Notif sukses persis kayak confirm awal
            alert(data.message); 
        } else {
            alert('Gagal menghapus gambar');
        }
    })
    .catch(err => alert('Terjadi kesalahan.'));
}




    // Tambah spesifikasi baru
    function addSpec() {
      const wrapper = document.getElementById('specifications-wrapper');
      const index = wrapper.children.length;
      const div = document.createElement('div');
      div.classList.add('flex', 'gap-2');
      div.innerHTML = `
        <input type="text" name="specifications[${index}][key]" placeholder="Nama spesifikasi"
               class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
        <input type="text" name="specifications[${index}][value]" placeholder="Nilai"
               class="w-1/2 border-gray-300 rounded-lg px-2 py-1">
        <button type="button" onclick="removeSpec(this)" class="text-red-500 font-bold">×</button>
      `;
      wrapper.appendChild(div);
    }

    // Hapus spesifikasi
    function removeSpec(button) {
      button.closest('div').remove();
    }
  </script>
</x-app-layout>
