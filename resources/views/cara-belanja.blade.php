<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cara Belanja - Sallavia Gadget</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

  <!-- Header Section -->
  <header class="text-center mt-10 py-10 bg-blue-50 border-b border-blue-100">
    <h1 class="text-3xl font-bold text-blue-700 mb-2">Cara Belanja di Sallavia Gadget</h1>
    <p class="text-gray-500 text-sm">Mudah, cepat, dan langsung lewat WhatsApp</p>
  </header>

  <!-- Content Section -->
  <main class="max-w-4xl mx-auto px-6 py-12 leading-relaxed text-gray-700">

    <h2 class="text-xl font-semibold text-blue-600 mb-3">1. Pilih Produk</h2>
    <p class="mb-6">
      Telusuri katalog produk kami di website, pilih produk yang ingin dibeli, lalu catat nama dan jumlah produk.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">2. Hubungi via WhatsApp</h2>
    <p class="mb-6">
      Klik tombol WhatsApp di pojok kanan bawah atau gunakan link berikut: 
      <a href="https://wa.me/6281234567890?text=Halo%20Sallavia%20Gadget,%20saya%20ingin%20memesan%20produk" 
         class="text-blue-600 hover:underline" target="_blank">Chat WhatsApp</a>.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">3. Konfirmasi Pesanan</h2>
    <p class="mb-6">
      Sebutkan nama produk, jumlah, dan alamat pengiriman kepada admin kami. Admin akan memverifikasi ketersediaan stok.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">4. Metode Pembayaran</h2>
    <p class="mb-6">
      Lakukan pembayaran sesuai instruksi admin, bisa via transfer bank, e-wallet, atau metode lain yang tersedia.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">5. Konfirmasi Pembayaran</h2>
    <p class="mb-6">
      Kirim bukti pembayaran melalui WhatsApp agar pesanan segera diproses dan dikirim ke alamat Anda.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">6. Pengiriman</h2>
    <p class="mb-6">
      Produk akan dikirim setelah pembayaran dikonfirmasi. Anda akan menerima nomor resi pengiriman untuk melacak paket.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">7. Hubungi Kami</h2>
    <p>
      Jika ada pertanyaan atau kendala, hubungi admin melalui WhatsApp: 
      <a href="https://wa.me/6281234567890?text=Halo%20Sallavia%20Gadget,%20saya%20butuh%20bantuan" 
         class="text-blue-600 hover:underline" target="_blank">Chat WhatsApp</a>.
    </p>

  </main>

  <!-- WhatsApp Button -->
  <div class="button-whatsapp">
    <a href="https://wa.me/6281234567890?text=Halo%20Sallavia%20Gadget,%20saya%20ingin%20memesan%20produk" target="_blank">
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>

  <!-- CSS Button WA -->
  <style>
    .button-whatsapp {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        z-index: 9999;
        background-color: #25D366;
        padding: 12px 14px;
        border-radius: 8px 0 0 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .button-whatsapp a {
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    .button-whatsapp i {
        color: #fff;
        font-size: 24px;
    }
    .button-whatsapp:hover {
        background-color: #1ebe57;
        transform: translateY(-50%) scale(1.1);
    }
  </style>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
