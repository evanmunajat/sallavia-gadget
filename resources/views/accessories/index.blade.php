<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center justify-between">
            {{ __('Daftar Aksesoris') }}
            <a href="{{ route('accessories.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
               + Tambah Produk
            </a>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl p-8">
                @if(isset($products) && count($products))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="border border-gray-200 rounded-xl shadow hover:shadow-md transition p-5 flex flex-col justify-between">
                                <div>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-40 object-cover rounded-lg mb-4">
                                    @else
                                        <div class="w-full h-40 bg-gray-100 flex items-center justify-center rounded-lg mb-4 text-gray-400">
                                            No Image
                                        </div>
                                    @endif

                                    <h4 class="font-semibold text-gray-800 text-lg mb-1">
                                        {{ $product->name }}
                                    </h4>
                                    <p class="text-gray-500 text-sm mb-3">{{ Str::limit($product->description, 60) }}</p>
                                    <p class="font-bold text-blue-600 text-lg">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="mt-4 flex justify-between">
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-10 text-lg">Belum ada produk yang ditambahkan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
