@extends('layouts.admin')

@section('title', 'Kelola Konten Halaman Welcome')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Konten Halaman Welcome') }}
            </h2>
            <a href="{{ route('admin.welcome-elements.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i>Tambah Konten Baru
            </a>
        </div>

        <!-- Mobile Header -->
        <div class="block md:hidden mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4">
                {{ __('Kelola Konten Halaman Welcome') }}
            </h2>
            <a href="{{ route('admin.welcome-elements.create') }}"
                class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center">
                <i class="fas fa-plus mr-2"></i>Tambah Konten Baru
            </a>
        </div>
            <!-- Info Panel -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                            Panduan Kelola Konten Welcome
                        </h3>
                        <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                            <p>Halaman ini digunakan untuk mengelola semua konten yang tampil di halaman depan website Desa Kala. Anda dapat mengubah teks, gambar, dan informasi lainnya.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter by Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">Filter Berdasarkan Bagian</h3>
                    <!-- Desktop Version: Button Filter -->
                    <div class="hidden md:flex flex-wrap gap-2">
                        <a href="{{ route('admin.welcome-elements.index') }}"
                           class="px-3 py-1 rounded-full text-sm {{ !request('section') ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} hover:bg-blue-200 transition">
                            Semua
                        </a>
                        @foreach(['navbar', 'hero', 'profile', 'location', 'agriculture', 'culture', 'footer'] as $section)
                            <a href="{{ route('admin.welcome-elements.index', ['section' => $section]) }}"
                               class="px-3 py-1 rounded-full text-sm {{ request('section') == $section ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} hover:bg-blue-200 transition">
                                {{ ucfirst($section) }}
                            </a>
                        @endforeach
                    </div>
                    <!-- Mobile Version: Select Dropdown -->
                    <div class="block md:hidden">
                        <select onchange="window.location.href = this.value"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-200">
                            <option value="{{ route('admin.welcome-elements.index') }}" {{ !request('section') ? 'selected' : '' }}>
                                Semua
                            </option>
                            @foreach(['navbar', 'hero', 'profile', 'location', 'agriculture', 'culture', 'footer'] as $section)
                                <option value="{{ route('admin.welcome-elements.index', ['section' => $section]) }}" {{ request('section') == $section ? 'selected' : '' }}>
                                    {{ ucfirst($section) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Desktop Table View -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Bagian Halaman
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Jenis Konten
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Isi Konten
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($elements as $element)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($element->element_type == 'navbar') bg-purple-100 text-purple-800
                                                @elseif($element->element_type == 'hero') bg-blue-100 text-blue-800
                                                @elseif($element->element_type == 'profile') bg-green-100 text-green-800
                                                @elseif($element->element_type == 'location') bg-yellow-100 text-yellow-800
                                                @elseif($element->element_type == 'agriculture') bg-orange-100 text-orange-800
                                                @elseif($element->element_type == 'culture') bg-pink-100 text-pink-800
                                                @elseif($element->element_type == 'footer') bg-gray-100 text-gray-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($element->element_type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $element->getElementKeyLabel() }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                            <div class="max-w-xs">
                                                @if(strlen($element->content) > 50)
                                                    <span title="{{ $element->content }}">{{ substr($element->content, 0, 50) }}...</span>
                                                @else
                                                    {{ $element->content }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($element->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.welcome-elements.edit', $element) }}"
                                                    class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.welcome-elements.destroy', $element) }}"
                                                      class="inline"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini? Konten yang dihapus tidak akan muncul di halaman website.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 transition">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="block md:hidden space-y-4">
                        @foreach($elements as $element)
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                @if($element->element_type == 'navbar') bg-purple-100 text-purple-800
                                                @elseif($element->element_type == 'hero') bg-blue-100 text-blue-800
                                                @elseif($element->element_type == 'profile') bg-green-100 text-green-800
                                                @elseif($element->element_type == 'location') bg-yellow-100 text-yellow-800
                                                @elseif($element->element_type == 'agriculture') bg-orange-100 text-orange-800
                                                @elseif($element->element_type == 'culture') bg-pink-100 text-pink-800
                                                @elseif($element->element_type == 'footer') bg-gray-100 text-gray-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($element->element_type) }}
                                            </span>
                                            @if($element->is_active)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </div>
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">
                                            {{ $element->getElementKeyLabel() }}
                                        </h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-300">
                                            @if(strlen($element->content) > 100)
                                                <span title="{{ $element->content }}">{{ substr($element->content, 0, 100) }}...</span>
                                            @else
                                                {{ $element->content }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex space-x-2 mt-4">
                                    <a href="{{ route('admin.welcome-elements.edit', $element) }}"
                                        class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-md text-sm font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.welcome-elements.destroy', $element) }}"
                                          class="flex-1"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten ini? Konten yang dihapus tidak akan muncul di halaman website.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 rounded-md text-sm font-medium text-red-700 bg-red-100 hover:bg-red-200 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($elements->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada konten welcome</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai tambahkan konten untuk halaman depan website Desa Kala.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.welcome-elements.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah Konten Pertama
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Pagination -->
                    @if($elements->hasPages())
                        <div class="mt-6">
                            {{ $elements->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
