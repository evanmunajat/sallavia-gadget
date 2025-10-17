@extends('layouts.frontend')

@section('content')

<!-- Page Header Produk -->
<div class="container">
<section class="page-header">
    <h1 class="page-title">Tentang Sallavia Gadget</h1>
    <p class="page-subtitle">
      Sallavia Gadget hadir untuk memberikan produk elektronik dan aksesoris berkualitas tinggi dengan layanan pelanggan terbaik. Kami berkomitmen untuk menghadirkan pengalaman belanja yang cepat, aman, dan menyenangkan bagi setiap pelanggan.
    </p>
    </p>
  </section>


<!-- ====== TENTANG SALLAVIA GADGET 2x2 ====== -->
<section class="about-us-section py-16 bg-gray-50 mt-5">
  <div class="container mx-auto px-6 text-center">
    <div class="text-about">
      <h1 class="fw-bold color-blue mb-3">Tentang Sallavia Gadget</h1>
      <p class="text-gray-500 mb-12 max-w-3xl mx-auto text-justify">
  Sallavia Gadget adalah toko gadget terkemuka yang berkomitmen menghadirkan pengalaman belanja teknologi
  yang mudah, cepat, dan terpercaya bagi setiap pelanggan. Sejak berdirinya, kami selalu fokus pada penyediaan
  produk-produk berkualitas tinggi, mulai dari smartphone, tablet, hingga aksesoris gadget terbaru, dengan
  harga yang kompetitif dan layanan purna jual yang handal.  </p>

  <p>Kami percaya bahwa kepuasan pelanggan adalah prioritas utama, sehingga setiap transaksi ditangani dengan
  profesionalisme dan transparansi penuh. Tim kami yang berpengalaman siap memberikan konsultasi produk, tips
  penggunaan, serta solusi cepat jika terjadi kendala. </p> 

  <p>Selain itu, Sallavia Gadget terus berinovasi untuk menghadirkan layanan modern, termasuk pengiriman cepat,
  kemudahan pembayaran, dan program garansi yang jelas. Visi kami adalah menjadi toko gadget pilihan utama
  di Indonesia, yang tidak hanya menyediakan produk berkualitas, tetapi juga membangun kepercayaan jangka panjang
  dengan setiap pelanggan. Dengan Sallavia Gadget, membeli gadget bukan sekadar transaksi, tetapi pengalaman
  yang menyenangkan, aman, dan memuaskan.</p>


</div>


    <div class="about-cards grid grid-cols-1 md:grid-cols-2 gap-8 mt-5 py-5">
      <!-- Card 1 -->
      <div class="about-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
        <div class="icon mb-4 text-blue-500 text-5xl">📱</div>
        <h3 class="text-xl font-semibold mb-2">Produk Berkualitas</h3>
        <p class="text-gray-500">
          Menyediakan gadget asli dan berkualitas dengan harga yang kompetitif untuk semua pelanggan.
        </p>
      </div>
      <!-- Card 2 -->
      <div class="about-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
        <div class="icon mb-4 text-green-500 text-5xl">⚡</div>
        <h3 class="text-xl font-semibold mb-2">Layanan Cepat</h3>
        <p class="text-gray-500">
          Pengiriman cepat dan layanan after-sales yang siap membantu kapan saja.
        </p>
      </div>
      <!-- Card 3 -->
      <div class="about-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
        <div class="icon mb-4 text-purple-500 text-5xl">🤝</div>
        <h3 class="text-xl font-semibold mb-2">Kepercayaan</h3>
        <p class="text-gray-500">
          Selalu menjaga kepercayaan pelanggan dengan transparansi dan layanan terbaik.
        </p>
      </div>
      <!-- Card 4 -->
      <div class="about-card p-6 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300">
        <div class="icon mb-4 text-red-500 text-5xl">🚀</div>
        <h3 class="text-xl font-semibold mb-2">Visi Masa Depan</h3>
        <p class="text-gray-500">
          Menjadi toko gadget terkemuka yang selalu menghadirkan inovasi dan pengalaman belanja terbaik.
        </p>
      </div>
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

<!-- ====== SOCIAL MEDIA GRID 2x2 HORIZONTAL ====== -->
<section class="social-section py-16 bg-gray-50 py-5 mt-5">
  <div class="container mx-auto px-6 max-w-3xl text-center">
    <h2 class="fw-bold color-blue mb-3">Ikuti Kami di Media Sosial & Toko Online Shop</h2>

    <div class="social-grid grid grid-cols-1 sm:grid-cols-2 gap-6 mt-5">
      <!-- Instagram -->
      <a href="https://instagram.com/sallavia_gadget" target="_blank" class="social-card p-6 bg-white rounded-3xl shadow-social transition flex items-center">
        <i class="fab fa-instagram text-pink-500 text-5xl mr-4"></i>
        <span class="text-gray-800 font-bold text-xl">Instagram</span>
      </a>

      <!-- TikTok -->
      <a href="https://www.tiktok.com/@sallavia.gadget" target="_blank" class="social-card p-6 bg-white rounded-3xl shadow-social transition flex items-center">
        <i class="fab fa-tiktok text-5xl mr-4"></i>
        <span class="text-gray-800 font-bold text-xl">TikTok</span>
      </a>

      <!-- Shopee -->
      <a href="https://shopee.co.id/sallavia.gadget" target="_blank" class="social-card p-6 bg-white rounded-3xl shadow-social transition flex items-center">
        <i class="fas fa-shopping-cart text-orange-500 text-5xl mr-4"></i>
        <span class="text-gray-800 font-bold text-xl">Shopee</span>
      </a>

      <!-- WhatsApp -->
      <a href="https://wa.me/6289505292668" target="_blank" class="social-card p-6 bg-white rounded-3xl shadow-social transition flex items-center">
        <i class="fab fa-whatsapp text-green-500 text-5xl mr-4"></i>
        <span class="text-gray-800 font-bold text-xl">WhatsApp</span>
      </a>
    </div>
  </div>
</section>


</div>
@endsection