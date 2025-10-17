@extends('layouts.frontend')

@section('content')

<!-- Hero Banner -->
<section class="hero-banner mt-5">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Teks Kiri -->
      <div class="text-header col-lg-6">
        <h1 class="fw-bold color-blue">
          {{ $heroBanner?->title ?? 'Selamat Datang di Sallavia Gadget' }}
        </h1>
        <p class="hero color-abu lead my-4">
          {{ $heroBanner?->subtitle ?? 'Temukan smartphone, aksesoris, dan gadget terbaru dengan harga terbaik!' }}
        </p>
        @if($heroBanner?->button_link)
          <a href="{{ $heroBanner->button_link }}" class="btn-cta">
            <i class="fa-solid fa-bag-shopping me-2"></i>
            {{ $heroBanner->button_text ?? 'Lihat Produk' }}
          </a>
        @endif
      </div>

      <!-- Gambar Kanan -->
      <div class="col-lg-6 text-center">
        <img 
          src="{{ $heroBanner?->image ? asset('storage/' . $heroBanner->image) : asset('img/hero/default.png') }}" 
          alt="{{ $heroBanner?->title ?? 'Hero Image' }}" 
          class="img-fluid hero-img"
        >
      </div>

    </div>
  </div>
</section>


<div class="container">


<!-- Section Kategori -->
<section class="categories mt-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="text-primary fw-bold">Kategori Produk</h2>
    </div>

    <div class="carousel-wrapper">
      <div class="carousel">
        <!-- Set 1 -->
        <div class="category-card"><i class="fa-solid fa-mobile-screen-button"></i><h6>Smartphone</h6></div>
        <div class="category-card"><i class="fa-solid fa-laptop"></i><h6>Laptop</h6></div>
        <div class="category-card"><i class="fa-solid fa-headphones"></i><h6>Headphone</h6></div>
        <div class="category-card"><i class="fa-solid fa-camera"></i><h6>Kamera</h6></div>
        <div class="category-card"><i class="fa-solid fa-gamepad"></i><h6>Gaming</h6></div>
        <div class="category-card"><i class="fa-solid fa-tablet-screen-button"></i><h6>Tablet</h6></div>
        <div class="category-card"><i class="fa-solid fa-charging-station"></i><h6>Charger</h6></div>
        <div class="category-card"><i class="fa-solid fa-plug"></i><h6>Aksesoris</h6></div>

        <!-- Set 2 (duplikat untuk looping mulus) -->
        <div class="category-card"><i class="fa-solid fa-mobile-screen-button"></i><h6>Smartphone</h6></div>
        <div class="category-card"><i class="fa-solid fa-laptop"></i><h6>Laptop</h6></div>
        <div class="category-card"><i class="fa-solid fa-headphones"></i><h6>Headphone</h6></div>
        <div class="category-card"><i class="fa-solid fa-camera"></i><h6>Kamera</h6></div>
        <div class="category-card"><i class="fa-solid fa-gamepad"></i><h6>Gaming</h6></div>
        <div class="category-card"><i class="fa-solid fa-tablet-screen-button"></i><h6>Tablet</h6></div>
        <div class="category-card"><i class="fa-solid fa-charging-station"></i><h6>Charger</h6></div>
        <div class="category-card"><i class="fa-solid fa-plug"></i><h6>Aksesoris</h6></div>
      </div>
    </div>
  </div>
</section>

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
                <h5 class="product-title mb-3">{{ $newarrival->name }}</h5>
                <!-- <p class="product-description">{{ Str::limit($newarrival->description, 80) }}</p> -->

                <div class="product-footer">
                    <span class="product-price">Rp {{ number_format($newarrival->price,0,',','.') }}</span>
                  <a href="{{ route('newarrival.show', $newarrival->id) }}" class="btn-order">
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



<section class="quality-section py-5 mt-5">
  <div class="container text-center">
    <p class="text-muted small mb-2">Beberapa alasan mengapa kami dipercaya</p>
    <h2 class="fw-bold color-blue mb-3">Kami Menyediakan Produk dengan Kualitas Terbaik</h2>
    <p class="text-secondary mb-5">
      Kepuasan pelanggan adalah prioritas kami — kami pastikan setiap produk memenuhi standar terbaik.
    </p>

    <div class="quality-grid">
      <!-- Item 1 -->
      <div class="quality-item">
        <div class="quality-icon icon text-5xl mb-3">📱</div>
        <h5 class="fw-semibold mb-2">Produk Berkualitas</h5>
        <p>Setiap produk dipilih dengan teliti untuk memastikan kualitas terbaik bagi pelanggan kami.</p>
      </div>

      <!-- Item 2 -->
      <div class="quality-item">
        <div class="quality-icon icon text-5xl mb-3">⚡</div>
        <h5 class="fw-semibold mb-2">Pengiriman Cepat</h5>
        <p>Kami pastikan pesanan Anda tiba dengan aman dan tepat waktu di setiap pembelian.</p>
      </div>

      <!-- Item 3 -->
      <div class="quality-item">
        <div class="quality-icon icon text-5xl mb-3">🤝</div>
        <h5 class="fw-semibold mb-2">Layanan Terpercaya</h5>
        <p>Tidak puas? Tim kami siap memberikan solusi dan layanan terbaik untuk semua pelanggan.</p>
      </div>
    </div>
  </div>
</section>



<!-- Promo -->
<section class="promo-section py-5 mt-5">
  <div class="container mx-auto px-4">
    <h2 class="text-center fw-bold color-blue mb-3">
      Dapatkan diskon menarik & produk paling populer minggu ini!
    </h2>

    <div class="promo-grid">
      @forelse($promos as $promo)
        <div class="promo-card group">
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

          {{-- Konten overlay --}}
          <div class="promo-content">
            <div class="promo-info">
              <p class="promo-subtitle text-sm mb-1">
                @if($promo->is_promo) Promo
                @elseif($promo->is_featured) Unggulan
                @endif
              </p>

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
        <p class="no-promos text-center">Belum ada produk promo menarik untuk minggu ini.</p>
      @endforelse
    </div>
  </div>
</section>





<!-- Section Produk -->
<section id="products" class="products-section py-5 mt-5">
    <h2>Temukan Produk Terbaik untuk Anda</h2>
    <div class="products-grid">
        @forelse($products as $product)
        <div class="product-card">
            {{-- Kondisi Produk --}}
            <p class="product-condition">{{ ucfirst($product->condition) }}</p>

            {{-- Gambar Utama Produk --}}
<div class="product-image">
    @php
        $mainImage = $product->images->firstWhere('is_main', true) ?? $product->images->first();
    @endphp

    <img 
        src="{{ $mainImage ? asset('storage/' . $mainImage->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
        alt="{{ $product->name }}"
        class="w-full h-48 object-cover rounded-lg"
    >
</div>


            {{-- Konten --}}
            <div class="product-content">
                <h5 class="product-title mb-3">{{ $product->name }}</h5>

                <div class="product-footer">
                    <span class="product-price">Rp {{ number_format($product->price,0,',','.') }}</span>
                    <a href="{{ route('show', $product->id) }}" class="btn-order">
                        <i class="fa-solid fa-eye"></i> Lihat Produk
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="no-products">Belum ada produk tersedia.</p>
        @endforelse
    </div>
</section>



<!-- Testimoni --> 
<section class="testimoni py-5 mt-5">
  <div class="text-judus-testimoni text-center">
    <h2 class="text-center fw-bold color-blue mb-3">Apa Kata Pelanggan</h2>
    <p class="text-gray-500 mb-12">Kami selalu memberikan pengalaman terbaik bagi pelanggan.</p>
  </div>

  <div class="carousel-wrapper">
    <div class="testimoni-group">

      <!-- Card 1 -->
      <div class="card">
        <div class="header">
          <span class="icon">
            <img src="{{ asset('asset/img/ridho.jpeg') }}" alt="Ridho">
          </span>
          <p class="name-testimoni">Ridho Nawawi Kudsy.</p>
        </div>
        <p class="message">
          Sallavia Gadget selalu memberikan pelayanan cepat dan produk berkualitas. Sangat puas dengan pengalaman belanja saya!
        </p>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <div class="header">
          <span class="icon">
            <img src="{{ asset('asset/img/iqfi.jpeg') }}" alt="Profil" class="avatar-img">
          </span>
          <p class="name-testimoni">Iqfi Khoirul Anam.</p>
        </div>
        <p class="message">
          Produk yang dikirim selalu sesuai deskripsi dan packing rapi. Website Sallavia Gadget juga mudah digunakan.
        </p>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <div class="header">
          <span class="icon">
            <img src="{{ asset('asset/img/gilang.jpeg') }}" alt="Profil" class="avatar-img">
          </span>
          <p class="name-testimoni">Gilang Cahya Asafah.</p>
        </div>
        <p class="message">
          Harga yang bersaing dan promo selalu up-to-date. Customer service juga ramah dan responsif.
        </p>
      </div>

      <!-- Card 4 -->
      <div class="card">
        <div class="header">
          <span class="icon">
            <img src="{{ asset('asset/img/azzam.jpeg') }}" alt="Profil" class="avatar-img">
          </span>
          <p class="name-testimoni">Azzam Jihaddien.</p>
        </div>
        <p class="message">
          Belanja di Sallavia Gadget selalu menyenangkan, website cepat, dan produk sampai dengan aman.
        </p>
      </div>

    </div>

    <!-- carousel buttons -->
    <div class="carousel-buttons">
      <button class="carousel-btn prev">
        <i class="fa-solid fa-arrow-left"></i>
      </button>
      <button class="carousel-btn next">
        <i class="fa-solid fa-arrow-right"></i>
      </button>
    </div>

  </div>
</section>

<!-- Floating WA di samping scroll -->
 <div class="button-whatsapp">
   <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Sallavia Gadget, saya mau bertanya') }}"
   target="_blank" >
   <i class="fab fa-whatsapp"></i>
  </a>
</div>





</div>
@endsection
