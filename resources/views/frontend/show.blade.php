@extends('layouts.frontend')

@section('content')
<section class="single-product-section py-20 bg-gradient-to-b from-gray-50 to-white mt-5">
  <div class="container mx-auto px-6 lg:px-8">

    <div class="single-product-card flex flex-col lg:flex-row gap-8">

      <!-- GALLERY -->
      <div class="single-product-image flex-1">
        @php
            $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
        @endphp
        <div class="main-image-container mb-4 lg:mb-6">
          <img 
            id="mainImage"
            src="{{ $mainImage ? asset('storage/' . $mainImage->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
            alt="{{ $product->name }}">
        </div>

        @if($product->images->count() > 1)
        <div class="thumbnail-gallery flex gap-2 flex-wrap mb-4">
          @foreach($product->images as $img)
            <img 
              src="{{ asset('storage/' . $img->image) }}" 
              alt="Thumbnail {{ $loop->iteration }}" 
              class="thumbnail cursor-pointer border-2 border-gray-200 rounded hover:border-blue-500"
              onclick="document.getElementById('mainImage').src='{{ asset('storage/' . $img->image) }}'">
          @endforeach
        </div>
        @endif
      </div>

      <!-- DETAIL -->
      <div class="single-product-info flex-1 flex flex-col justify-between">
        <div>
          @if($product->is_featured)
          @endif
          <div class="single-product-buttons2 mb-3">
           <a href="{{ route('frontend.produk.index') }}" class="btn-back flex items-center gap-2">
           <i class="fas fa-arrow-left"></i> Kembali
           </a>
          </div>

          <h3 class="single-product-title mt-2">{{ $product->name }}</h3>

           <p class="single-product-price">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p>

         <!-- Spesifikasi -->
@php
    // Ambil spesifikasi dari product
    $specs = $product->specifications;

    // Decode JSON kalau masih string
    if (is_string($specs)) {
        $specs = json_decode($specs, true);
    }

    // Pastikan selalu array
    $specs = is_array($specs) ? $specs : [];

    // Flatten nested array jika perlu
    $flattenedSpecs = [];
    foreach ($specs as $item) {
        if (is_array($item) && isset($item['key']) && isset($item['value'])) {
            // Format lama: array of key/value
            $flattenedSpecs[] = $item;
        } elseif (is_array($item)) {
            // Merge associative array
            $flattenedSpecs = array_merge($flattenedSpecs, $item);
        }
    }

    // Pilih data final untuk ditampilkan
    if (!empty($flattenedSpecs) && isset($flattenedSpecs[0]['key'])) {
        // Masih format lama
        $specsFinal = $flattenedSpecs;
        $isPairArray = true;
    } else {
        // Format associative array
        $specsFinal = !empty($flattenedSpecs) ? $flattenedSpecs : $specs;
        $isPairArray = false;
    }
@endphp

@if(!empty($specsFinal))
<div class="single-product-specs bg-gray-50 p-4 rounded-lg shadow-inner mt-4">
  <h2 class="text-lg font-semibold mb-2">Spesifikasi</h2>
  <ul class="list-disc list-inside space-y-1">
    @if($isPairArray)
        {{-- Format array of {"key": "...", "value": "..."} --}}
        @foreach($specsFinal as $spec)
            @if(isset($spec['key']) && isset($spec['value']))
                <li><strong>{{ ucfirst($spec['key']) }}:</strong> {{ $spec['value'] }}</li>
            @endif
        @endforeach
    @else
        {{-- Format associative array {"Kondisi": "Second", "Warna": "Pink"} --}}
        @foreach($specsFinal as $key => $value)
            <li><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</li>
        @endforeach
    @endif
  </ul>
</div>
@endif

        </div>

          <!-- <p class="single-product-price mt-2">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p> -->

        <!-- Tombol -->
        <div class="single-product-buttons mt-6 flex flex-wrap gap-3">
          <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sallavia Gadget, saya mau pesan ' . $product->name) }}" 
             class="btn-whatsapp flex items-center gap-2">
            <i class="fa-brands fa-whatsapp"></i> Order via WhatsApp
          </a>
        </div>

      </div>

    </div>

    <!-- DESKRIPSI: berada di bawah card -->
    <div class="single-product-description mt-6 bg-gray-50 p-6 rounded-lg shadow-inner">
      <h2 class="text-center fw-bold color-blue mb-3">Keterangan</h2>
      @foreach(explode("\n\n", $product->description ?? '-') as $paragraph)
         <p class="mb-3">{{ $paragraph }}</p>
      @endforeach
    </div>

    

  </div>
</section>
@endsection
