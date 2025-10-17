<nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">
      <img src="{{ asset('asset/img/logo/logo_Sallavia2.png') }}" alt="Logo Sallavia" class="nav-logo">
    </a>
    
    <!-- Hamburger -->
    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
      <span></span>
      <span></span>
      <span></span>
    </button>
    
    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::routeIs('frontend.produk.index') ? 'active' : '' }}" href="{{ route('frontend.produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::routeIs('frontend.about') ? 'active' : '' }}" href="{{ route('frontend.about') }}">Tentang Kami</a>
        </li>
        <li class="nav-item ms-lg-3">
          <a href="https://wa.me/6281234567890" class="btn btn-light btn-sm text-primary fw-bold rounded-pill">
            <i class="fa-brands fa-whatsapp me-1"></i> Chat WA
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
