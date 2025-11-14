@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Galeri Desa') }}
            </h2>
            <a href="{{ route('admin.galeri.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Galeri
            </a>
        </div>

        <!-- Mobile Header -->
        <div class="block md:hidden mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Manajemen Galeri Desa') }}
            </h2>
            <a href="{{ route('admin.galeri.create') }}"
                class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center">
                <i class="fas fa-plus mr-2"></i>Tambah Galeri
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Album</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($galeri as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->is_parent)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($item->children->take(3) as $child)
                                                <img src="{{ asset($child->gambar) }}" alt="{{ $child->judul }}" class="h-12 w-12 object-cover rounded">
                                            @endforeach
                                            @if($item->children->count() > 3)
                                                <span class="text-xs text-gray-500 dark:text-gray-300">+{{ $item->children->count() - 3 }} more</span>
                                            @endif
                                        </div>
                                    @else
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="h-16 w-16 object-cover rounded">
                                        @else
                                            <div class="h-16 w-16 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                                <span class="text-gray-500 dark:text-gray-300 text-xs">No Image</span>
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ Str::limit($item->judul, 30) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ ucfirst($item->kategori) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->album }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    {{ $item->tanggal->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400">
                                                <i class="fas fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada data galeri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($galeri->hasPages())
                <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    {{ $galeri->links() }}
                </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden space-y-4">
            @forelse($galeri as $item)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                @if($item->is_parent)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($item->children->take(3) as $child)
                                            <img src="{{ asset($child->gambar) }}" alt="{{ $child->judul }}" class="h-12 w-12 object-cover rounded">
                                        @endforeach
                                        @if($item->children->count() > 3)
                                            <span class="text-xs text-gray-500 dark:text-gray-300">+{{ $item->children->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @else
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="h-16 w-16 object-cover rounded">
                                    @else
                                        <div class="h-16 w-16 bg-gray-200 dark:bg-gray-600 rounded flex items-center justify-center">
                                            <span class="text-gray-500 dark:text-gray-300 text-xs">No Image</span>
                                        </div>
                                    @endif
                                @endif
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $item->judul }}</h3>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ ucfirst($item->kategori) }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ Str::limit($item->deskripsi, 100) }}</p>
                            <div class="grid grid-cols-2 gap-2 text-sm">
                                <div>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Album:</span>
                                    <span class="text-gray-900 dark:text-gray-100">{{ $item->album ?: '-' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-500 dark:text-gray-400">Tanggal:</span>
                                    <span class="text-gray-900 dark:text-gray-100">{{ $item->tanggal->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                @if($item->is_active)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>Tidak Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('admin.galeri.edit', $item->id) }}"
                            class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-md text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800 transition">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.galeri.destroy', $item->id) }}"
                              class="flex-1"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 rounded-md text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800 transition">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fas fa-images text-gray-400 text-6xl mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada galeri yang ditambahkan</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai tambahkan galeri untuk memperkenalkan kegiatan dan panorama desa Anda.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.galeri.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>Tambah Galeri Pertama
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
