<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ProfileController,
    BannerController,
    PromoController,
    ProductController,
    AccessoriesController,
    NewArrivalController,
    HomeController,
    Frontend\ProdukController,
    ShowController
};
use App\Models\Product;

// ==========================
// ✅ FRONTEND ROUTES
// ==========================

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Produk (frontend)
Route::get('/produk', [ProdukController::class, 'index'])->name('frontend.produk.index');

// Tentang Kami
Route::get('/tentang-kami', [App\Http\Controllers\Frontend\TentangKamiController::class, 'index'])
    ->name('frontend.about');

// Detail Produk (frontend)
Route::get('/show/{id}', [ProductController::class, 'show'])->name('show');

// Kebijakan & Informasi Umum
Route::view('/privacy-policy', 'privacy-policy')->name('privacy.policy');
Route::view('/cara-belanja', 'cara-belanja')->name('cara.belanja');
Route::view('/syarat-ketentuan', 'syarat-ketentuan')->name('syarat.ketentuan');


// ==========================
// ✅ DASHBOARD / BACKEND ROUTES
// ==========================

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profil User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Produk (backend) - gunakan resource penuh
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

    // Hapus gambar tambahan (satu-satu)
    Route::delete('/products/images/{id}', [ProductController::class, 'destroyImage'])
        ->name('products.images.destroy');
});

// Accessories
Route::middleware(['auth'])->group(function () {
    Route::resource('accessories', AccessoriesController::class);
});

// New Arrival
Route::middleware(['auth'])->group(function () {
    Route::resource('newarrival', NewArrivalController::class);
});

// Banner
Route::middleware(['auth'])->group(function () {
    Route::resource('banners', BannerController::class);
});

// Promo
Route::middleware(['auth'])->group(function () {
    Route::resource('promo', PromoController::class);
});

// Detail Halaman Promo
Route::get('/promo/{promo}', [PromoController::class, 'show'])->name('promoproducts.show');

// Halaman detail (show)
Route::get('/newarrival/{id}', [NewArrivalController::class, 'show'])->name('newarrival.show');

Route::delete('/newarrival/images/{image}', [NewArrivalController::class, 'destroyImage'])->name('newarrival.images.destroy');

// products
Route::delete('/products/images/{id}', [ProductController::class, 'destroyImage'])
     ->name('products.images.destroy');

// Route khusus hapus gambar via AJAX (kalau nanti perlu)
Route::delete('/newarrival/images/{id}', [NewArrivalController::class, 'destroyImage'])->name('newarrival.images.destroy');


// Auth routes (login/register/logout)
require __DIR__.'/auth.php';
