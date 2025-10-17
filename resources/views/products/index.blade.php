<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Daftar Produk') }}
            <a href="{{ route('products.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
               + Tambah Produk
            </a>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl p-8">

                {{-- Table --}}
                @if(isset($products) && count($products))
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spesifikasi</th> {{-- Kolom baru --}}
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($products as $index => $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($product->image)
                                                <img src="{{ asset('storage/' . $product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-16 h-16 object-cover rounded-lg">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400 text-xs">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                        
                                        {{-- Kondisi --}}
                                        <td class="py-3 px-5 border-b">
                                            @if($product->condition === 'new')
                                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                    Baru
                                                </span>
                                            @elseif($product->condition === 'second')
                                                <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                    Second
                                                </span>
                                            @elseif($product->condition === 'refurbished')
                                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                    Refurbished
                                                </span>
                                            @else
                                                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">
                                                    Tidak diketahui
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Deskripsi --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($product->description, 60) }}</td>

                                        {{-- Spesifikasi --}}
@php
    // Ambil spesifikasi dari product
    $specs = $product->specifications;

    // Jika masih string (JSON), decode dulu
    if (is_string($specs)) {
        $specs = json_decode($specs, true);
    }

    // Pastikan selalu array
    $specs = is_array($specs) ? $specs : [];

    // Deteksi apakah formatnya array of {"key": "...", "value": "..."}
    $isPairArray = isset($specs[0]['key']) && isset($specs[0]['value']);
@endphp

<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
    @if(!empty($specs))
        @if($isPairArray)
            {{-- Format lama: array of key/value --}}
            @foreach($specs as $spec)
                @if(isset($spec['key']) && isset($spec['value']))
                    <div><strong>{{ ucfirst($spec['key']) }}:</strong> {{ $spec['value'] }}</div>
                @endif
            @endforeach
        @else
            {{-- Format baru: associative array --}}
            @foreach($specs as $key => $value)
                <div><strong>{{ ucfirst($key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</div>
            @endforeach
        @endif
    @else
        <span class="text-gray-400">-</span>
    @endif
</td>


                                        {{-- Harga --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-10 text-lg">Belum ada produk yang ditambahkan.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
