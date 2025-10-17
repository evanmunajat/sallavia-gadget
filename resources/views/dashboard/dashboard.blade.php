<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-5">Statistik Website</h3>

              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                  <!-- Total Pengunjung -->
                  <div class="bg-gradient-to-r from-blue-700 to-blue-600 text-white p-6 rounded-lg shadow-md text-center flex flex-col items-center gap-2 hover:scale-105 transition-transform duration-300">
                      <i class="fas fa-users text-2xl"></i>
                      <p class="text-sm opacity-80">Total Pengunjung</p>
                      <p class="text-3xl font-bold mt-1">{{ $totalVisitors }}</p>
                  </div>

                  <!-- Total Produk -->
                  <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6 rounded-lg shadow-md text-center flex flex-col items-center gap-2 hover:scale-105 transition-transform duration-300">
                      <i class="fas fa-box-open text-2xl"></i>
                      <p class="text-sm opacity-80">Produk Terdaftar</p>
                      <p class="text-3xl font-bold mt-1">{{ \App\Models\Product::count() + \App\Models\NewArrival::count() }}</p>
                  </div>

                  <!-- Produk Baru 7 Hari -->
                  <div class="bg-gradient-to-r from-blue-500 to-blue-400 text-white p-6 rounded-lg shadow-md text-center flex flex-col items-center gap-2 hover:scale-105 transition-transform duration-300">
                      <i class="fas fa-star text-2xl"></i>
                      <p class="text-sm opacity-80">Produk Baru 7 Hari</p>
                      <p class="text-3xl font-bold mt-1">
                          {{ \App\Models\Product::where('created_at', '>=', now()->subDays(7))->count() + \App\Models\NewArrival::where('created_at', '>=', now()->subDays(7))->count() }}
                      </p>
                  </div>

                  <!-- New Arrival Baru 7 Hari -->
                  <div class="bg-gradient-to-r from-blue-400 to-blue-300 text-white p-6 rounded-lg shadow-md text-center flex flex-col items-center gap-2 hover:scale-105 transition-transform duration-300">
                      <i class="fas fa-gift text-2xl"></i>
                      <p class="text-sm opacity-80">New Arrival Baru 7 Hari</p>
                      <p class="text-3xl font-bold mt-1">
                          {{ \App\Models\NewArrival::where('created_at', '>=', now()->subDays(7))->count() }}
                      </p>
                  </div>

              </div>
          </div>
      </div>
  </div>
</x-app-layout>
