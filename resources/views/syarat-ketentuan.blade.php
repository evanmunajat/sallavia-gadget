<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Syarat & Ketentuan - Sallavia Gadget</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800">

  <!-- Header Section -->
  <header class="text-center mt-10 py-10 bg-blue-50 border-b border-blue-100">
    <h1 class="text-3xl font-bold text-blue-700 mb-2">Syarat & Ketentuan</h1>
    <p class="text-gray-500 text-sm">Harap dibaca sebelum melakukan pemesanan</p>
  </header>

  <!-- Content Section -->
  <main class="max-w-4xl mx-auto px-6 py-12 leading-relaxed text-gray-700">

    <h2 class="text-xl font-semibold text-blue-600 mb-3">1. Umum</h2>
    <p class="mb-6">
      Dengan menggunakan layanan Sallavia Gadget, Anda dianggap menyetujui semua syarat dan ketentuan yang berlaku. 
      Kami berhak untuk mengubah syarat & ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">2. Pemesanan</h2>
    <ul class="list-disc pl-6 mb-6">
      <li>Pesanan dilakukan melalui website atau WhatsApp resmi Sallavia Gadget.</li>
      <li>Pastikan data yang diberikan akurat, termasuk nama, alamat, dan nomor telepon.</li>
      <li>Stok produk tergantung ketersediaan pada saat pemesanan.</li>
    </ul>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">3. Pembayaran</h2>
    <p class="mb-6">
      Semua pembayaran harus dilakukan sesuai instruksi admin. Kami tidak bertanggung jawab atas transaksi yang dilakukan 
      di luar kanal resmi.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">4. Pengiriman</h2>
    <p class="mb-6">
      Produk akan dikirim setelah pembayaran dikonfirmasi. Waktu pengiriman dapat berbeda tergantung lokasi dan jasa 
      pengiriman yang digunakan.
    </p>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">5. Pengembalian & Refund</h2>
    <ul class="list-disc pl-6 mb-6">
      <li>Produk yang rusak atau salah kirim dapat dikembalikan dalam waktu maksimal 3 hari setelah diterima.</li>
      <li>Proses refund akan dilakukan setelah produk diterima kembali oleh Sallavia Gadget dan diperiksa kondisinya.</li>
    </ul>

    <h2 class="text-xl font-semibold text-blue-600 mb-3">6. Kontak</h2>
    <p class="mb-6">
      Untuk pertanyaan terkait syarat & ketentuan, silakan hubungi admin kami melalui WhatsApp:
      <a href="https://wa.me/6281234567890?text=Halo%20Sallavia%20Gadget,%20saya%20ingin%20bertanya%20tentang%20syarat%20dan%20ketentuan" 
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
