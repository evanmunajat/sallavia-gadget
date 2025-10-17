@extends('layouts.frontend')

@section('content')
<section class="single-product-section py-20 bg-gradient-to-b from-gray-50 to-white mt-5">
  <div class="container mx-auto px-6 lg:px-8">

    <div class="single-product-card flex flex-col lg:flex-row gap-8">

      <!-- GALLERY -->
      <div class="single-product-image flex-1">
        @php
            // Ambil semua gambar dari relasi
            $images = $newarrival->images ?? collect();

            // Gambar utama: pilih yang is_main=true, kalau nggak ada pakai $newarrival->image
            $mainImage = $images->firstWhere('is_main', true);
            $mainImageUrl = $mainImage
                ? asset('storage/' . $mainImage->image)
                : ($newarrival->image
                    ? asset('storage/' . $newarrival->image)
                    : 'https://via.placeholder.com/600x400?text=No+Image');
        @endphp

        {{-- Gambar utama --}}
        <div class="main-image-container mb-4 lg:mb-6">
          <img 
            id="mainImage"
            src="{{ $mainImageUrl }}" 
            alt="{{ $newarrival->name }}"
            class="w-full h-auto rounded-xl object-cover shadow-md transition-all duration-300">
        </div>

        {{-- Thumbnail --}}
        @if($images->count() > 0)
        <div class="thumbnail-gallery flex gap-2 flex-wrap mb-4">
          {{-- Kalau main image berasal dari field utama (dashboard) dan belum ada di relasi --}}
          @if(!$mainImage && $newarrival->image)
            <img 
              src="{{ asset('storage/' . $newarrival->image) }}" 
              alt="Thumbnail utama" 
              class="thumbnail w-20 h-20 object-cover cursor-pointer border-2 border-gray-200 rounded-lg hover:border-blue-500 transition-all duration-200"
              onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $newarrival->image) }}'">
          @endif

          {{-- Kalau main image ada di relasi, tampilkan semua --}}
          @foreach($images as $img)
            <img 
              src="{{ asset('storage/' . $img->image) }}" 
              alt="Thumbnail {{ $loop->iteration }}" 
              class="thumbnail w-20 h-20 object-cover cursor-pointer border-2 border-gray-200 rounded-lg hover:border-blue-500 transition-all duration-200"
              onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $img->image) }}'">
          @endforeach
        </div>
        @endif
      </div>

      <!-- DETAIL -->
      <div class="single-product-info flex-1 flex flex-col justify-between">
        <div>
          <div class="single-product-buttons2 mb-3">
            <a href="{{ route('newarrival.index') }}" class="btn-back flex items-center gap-2 text-gray-600 hover:text-gray-800 transition">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>

          <h3 class="single-product-title text-gray-800 mt-2">{{ $newarrival->name }}</h3>

           <p class="single-product-price text-2xl font-bold text-blue-600">
          Rp {{ number_format($newarrival->price, 0, ',', '.') }}
        </p>

          <!-- Spesifikasi -->
@php
    // Decode JSON kalau masih string
    $specs = is_string($newarrival->specifications)
        ? json_decode($newarrival->specifications, true)
        : $newarrival->specifications;

    // Pastikan selalu array
    $specs = is_array($specs) ? $specs : [];

    // Deteksi apakah formatnya array of key/value (seperti dari form)
    $isPairArray = isset($specs[0]['key']) && isset($specs[0]['value']);
@endphp

@if(!empty($specs))
<div class="single-product-specs bg-gray-50 p-4 rounded-lg shadow-inner mt-4">
  <h2 class="text-lg font-semibold mb-2">Spesifikasi</h2>
  <ul class="list-disc list-inside space-y-1">
    @if($isPairArray)
        {{-- Format array of {"key": "...", "value": "..."} --}}
        @foreach($specs as $spec)
            @if(isset($spec['key']) && isset($spec['value']))
                <li><strong>{{ ucfirst($spec['key']) }}:</strong> {{ $spec['value'] }}</li>
            @endif
        @endforeach
    @else
        {{-- Format associative array {"Kondisi": "Second", "Warna": "Purple"} --}}
        @foreach($specs as $key => $value)
            <li><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</li>
        @endforeach
    @endif
  </ul>
</div>
@endif


        </div>

        <div class="single-product-buttons mt-6 flex flex-wrap gap-3">
          <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sallavia Gadget, saya mau pesan ' . $newarrival->name) }}" 
             class="btn-whatsapp flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition-all">
            <i class="fa-brands fa-whatsapp"></i> Order via WhatsApp
          </a>
        </div>

      </div>

    </div>

    <!-- DESKRIPSI -->
    <div class="single-product-description mt-6 bg-gray-50 p-6 rounded-lg shadow-inner">
      <h2 class="text-center fw-bold color-blue mb-3">Keterangan</h2>
      @if($newarrival->description)
        @foreach(explode("\n\n", $newarrival->description) as $paragraph)
          <p class="mb-3 text-gray-700 leading-relaxed">{{ $paragraph }}</p>
        @endforeach
      @else
        <p class="text-gray-500 italic">Belum ada keterangan untuk produk ini.</p>
      @endif
    </div>

  </div>
</section>
@endsection
