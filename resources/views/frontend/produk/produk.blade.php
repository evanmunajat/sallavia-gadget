@extends('layouts.frontend')

@section('content')

<!-- Page Header Produk -->
<div class="container">
<section class="page-header">
    <h1 class="page-title">Produk Kami</h1>
    <p class="page-subtitle">
      Temukan produk terbaik dari Sallavia Gadget dengan kualitas dan harga terbaik.
    </p>
  </section>
</div>


<!-- Section New Arrival -->
<section class="new-arrival py-5 mt-5">
  <div class="container">
    <div class="text-center mb-5">
      <p class="text-muted mb-1">Kami Menyediakan Barang Berkualitas Tinggi</p>
      <h2 class="text-primary fw-bold">Kedatangan Barang Baru</h2>
      </div>
      
    <div class="new-grid">
      @forelse($newarrivals as $newarrival)
        <div class="new-card">
          <div class="new-img">
            @if($newarrival->image)
            {{-- Kondisi Produk --}}
             <p class="new-condition">{{ ucfirst($newarrival->condition) }}</p>
              <img src="{{ asset('storage/' . $newarrival->image) }}" alt="{{ $newarrival->name }}">
            @else
              <img src="https://via.placeholder.com/600x400?text=No+Image" alt="{{ $newarrival->name }}">
            @endif
          </div>
         <div class="product-content">
                <h5 class="product-title">{{ $newarrival->name }}</h5>
                <!-- <p class="product-description">{{ Str::limit($newarrival->description, 80) }}</p> -->

                <div class="product-footer">
                    <span class="product-price">Rp {{ number_format($newarrival->price,0,',','.') }}</span>
                    <a href="{{ route('show', $newarrival->id) }}" 
                      class="btn-order"
                      onclick="event.stopPropagation();">
                    <i class="fa-solid fa-eye"></i> Lihat Produk
                  </a>
                </div>
          </div>
        </div>
      @empty
        <p class="text-center text-gray-500">Belum ada produk New Arrival.</p>
      @endforelse
    </div>
  </div>
</section>

<section>
  <div class="container">
    <hr>
  </div>
</section>

<!-- Section Produk -->
<section id="products" class="products-section">
    <div class="products-grid">
        @forelse($products as $product)
        <div class="product-card">
            {{-- Kondisi Produk --}}
            <p class="product-condition">{{ ucfirst($product->condition) }}</p>

            {{-- Gambar --}}
            <div class="product-image">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
                     alt="{{ $product->name }}">
            </div>

            {{-- Konten --}}
            <div class="product-content">
                <h5 class="product-title">{{ $product->name }}</h5>
                <!-- <p class="product-description">{{ Str::limit($product->description, 80) }}</p> -->

                <div class="product-footer">
                    <span class="product-price">Rp {{ number_format($product->price,0,',','.') }}</span>
                    <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sallavia Gadget, saya mau pesan '.$product->name) }}" 
                       class="btn-order">
                       <i class="fa-brands fa-whatsapp"></i> Order WA
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="no-products">Belum ada produk tersedia.</p>
        @endforelse
    </div>
</section>


<!-- Promo -->
<section class="promo-section py-5 mt-5">
  <div class="container mx-auto px-4">
    <h2 class="text-center fw-bold color-blue mb-3"> Dapatkan diskon menarik &
       produk paling populer minggu ini!</h2>

    <div class="promo-grid">
      @forelse($promos as $index => $promo)
        @php
          // Tentukan lebar card: setiap pasangan 2 card
          $sizeClass = ($index % 4 == 0 || $index % 4 == 3) ? 'promo-wide' : 'promo-narrow';
        @endphp

        <div class="promo-card {{ $sizeClass }} group">
          {{-- Gambar --}}
          <div class="promo-image">
            @if($promo->image)
              <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->name }}">
            @else
              <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                No Image
              </div>
            @endif
          </div>

          <div class="promo-content">
            <div class="promo-info">
                {{-- Badge Promo / Unggulan --}}
                <p class="promo-subtitle text-sm mb-1">
                    @if($promo->is_promo) Promo
                    @elseif($promo->is_featured) Unggulan
                    @endif
                </p>

                {{-- Kondisi Produk --}}
                <p class="promo-condition">{{ ucfirst($promo->condition) }}</p>

                <h3 class="promo-title mt-1">{{ $promo->name }}</h3>
                <p class="promo-price font-bold mt-1">
                    Rp {{ number_format($promo->price, 0, ',', '.') }}
                </p>
            </div>

            <div class="promo-footer mt-3">
                <a href="https://wa.me/6281234567890?text={{ urlencode('Hallo, saya mau pesen '.$promo->name.' yang sedang promo, apakah masih promo produk tersebut?') }}" class="btn-promo">
                    <i class="fa-brands fa-whatsapp"></i> Order WA
                </a>
            </div>
          </div>
        </div>

      @empty
        <p class="no-promos text-center" style="text-align: center;">Belum ada produk promo meanatik untuk minggi ini.</p>
      @endforelse
    </div>
  </div>
</section>

@endsection