<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard'  ) }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
              <h3 class="text-lg font-semibold mb-5">Statistik Website</h3>

              <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                  <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md text-center">
                      <p class="text-sm opacity-80">Total Pengunjung</p>
                      <p class="text-3xl font-bold mt-2">{{ $totalVisitors }}</p>
                  </div>

                  <div class="bg-green-500 text-white p-6 rounded-lg shadow-md text-center">
                      <p class="text-sm opacity-80">Produk Terdaftar</p>
                      <p class="text-3xl font-bold mt-2">0</p>
                  </div>

                  <div class="bg-purple-500 text-white p-6 rounded-lg shadow-md text-center">
                      <p class="text-sm opacity-80">Pesanan Selesai</p>
                      <p class="text-3xl font-bold mt-2">0</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
