<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Promo Unggulan') }}
            <a href="{{ route('promo.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
               + Tambah Promo
            </a>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl p-8">

                {{-- Table Promo --}}
                @if(isset($promos) && count($promos))
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kondisi</th> {{-- Ganti status jadi kondisi --}}
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($promos as $index => $promo)
                                <tr class="bg-yellow-50 hover:bg-yellow-100 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($promo->image)
                                            <img src="{{ asset('storage/' . $promo->image) }}" 
                                                 alt="{{ $promo->name }}" 
                                                 class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400 text-xs">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $promo->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Str::limit($promo->description, 60) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">
                                        Rp {{ number_format($promo->price, 0, ',', '.') }}
                                    </td>

                                    {{-- ✅ Kondisi --}}
                                            <td class="py-3 px-5 border-b">
                                                @if($promo->condition === 'new')
                                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                        Baru
                                                    </span>
                                                @elseif($promo->condition === 'second')
                                                    <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                        Second
                                                    </span>
                                                @elseif($promo->condition === 'refurbished')
                                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                                        Refurbished
                                                    </span>
                                                @else
                                                    <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-3 py-1 rounded-full">
                                                        Tidak diketahui
                                                    </span>
                                                @endif
                                            </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                                        <a href="{{ route('promo.edit', $promo->id) }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus promo ini?')">
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
                    <p class="text-gray-500 text-center py-10 text-lg">Belum ada promo unggulan yang ditambahkan.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
