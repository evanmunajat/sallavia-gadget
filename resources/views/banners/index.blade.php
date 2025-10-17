<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Banners Header') }}
            </h2>
            <a href="{{ route('banners.create') }}" 
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow transition">
               <i class="fa-solid fa-plus"></i> + Tambah Banner
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Daftar Banner</h3>
            </div>
            
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-2 px-4 border">#</th>
                        <th class="py-2 px-4 border">Gambar</th>
                        <th class="py-2 px-4 border">Judul</th>
                        <th class="py-2 px-4 border">Subjudul</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr class="text-center">
                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2">
                                @if ($banner->image)
                                    <img src="{{ asset('storage/' . $banner->image) }}" class="w-32 rounded-lg shadow mx-auto">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $banner->title ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $banner->subtitle ?? '-' }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('banners.edit', $banner) }}" 
                                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition">
                                   Edit
                                </a>
                                <form action="{{ route('banners.destroy', $banner) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Hapus banner ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">Belum ada banner</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
