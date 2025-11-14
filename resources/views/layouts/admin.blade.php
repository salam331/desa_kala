<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased" x-data="{ open: false }">
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar Admin -->
        <div
            class="bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-200 w-64 min-h-screen flex flex-col shadow-xl fixed inset-y-0 left-0 z-50 transform transition-transform duration-300 ease-in-out lg:translate-x-0"
            :class="{ '-translate-x-full': !open, 'translate-x-0': open }">
            <!-- Logo & Title -->
            <div class="flex flex-col items-center justify-center py-6 border-b border-gray-700">
                <div class="bg-indigo-600 w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg mb-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    </svg>
                </div>
                <h1 class="text-lg font-bold tracking-wide">Admin Panel</h1>
                <p class="text-xs text-gray-400">Desa Kala Management</p>
            </div>

            <!-- Navigation -->
            <nav
                class="flex-1 px-4 py-6 space-y-2 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-900">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i> Dashboard
                </a>

                <!-- Pengaduan -->
                <a href="{{ route('admin.pengaduan') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.pengaduan') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-comments w-5 mr-3"></i> Pengaduan
                </a>

                <!-- Kelola Admin -->
                <a href="{{ route('admin.manage-admins') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.manage-admins') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-shield w-5 mr-3"></i> Kelola Admin
                </a>

                <!-- Welcome Elements -->
                <a href="{{ route('admin.welcome-elements.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.welcome-elements.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-globe w-5 mr-3"></i> Halaman Utama
                </a>

                <!-- Berita -->
                <a href="{{ route('admin.berita.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.berita.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-newspaper w-5 mr-3"></i> Kelola Berita
                </a>

                <!-- Profil Desa -->
                <a href="{{ route('admin.profil-desa.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.profil-desa.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-map-marker-alt w-5 mr-3"></i> Profil Desa
                </a>

                <!-- Struktur Pemerintahan -->
                <a href="{{ route('admin.struktur-pemerintahan.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.struktur-pemerintahan.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-sitemap w-5 mr-3"></i> Struktur Pemerintahan
                </a>

                <!-- Layanan Publik -->
                <a href="{{ route('admin.layanan.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.layanan.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-concierge-bell w-5 mr-3"></i> Layanan Publik
                </a>

                <!-- Potensi Desa -->
                <a href="{{ route('admin.potensi.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.potensi.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-star w-5 mr-3"></i> Potensi Desa
                </a>

                <!-- Galeri Desa -->
                <a href="{{ route('admin.galeri.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.galeri.*') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-images w-5 mr-3"></i> Galeri Desa
                </a>

                <!-- Log Aktivitas -->
                <a href="{{ route('admin.logs') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.logs') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-history w-5 mr-3"></i> Log Aktivitas
                </a>

                <!-- Profil Admin -->
                <a href="{{ route('admin.profile') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.profile') ? 'bg-indigo-600 text-white shadow-md' : 'hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-user-circle w-5 mr-3"></i> Profil Admin
                </a>
            </nav>

            <!-- Footer User Info -->
            <div class="px-4 py-5 border-t border-gray-700">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center mr-3 shadow-md">
                        <span
                            class="text-sm font-semibold text-white uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-300 rounded-lg bg-gray-800 hover:bg-red-600 hover:text-white transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5 mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Font Awesome CDN -->
        <script src="https://kit.fontawesome.com/a2e0f1f1f9.js" crossorigin="anonymous"></script>


        <!-- Mobile Overlay -->
        <div x-show="open" @click="open = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-45 lg:hidden"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-64">
            <!-- Top Bar -->
            <header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg mb-4 fixed top-0 left-0 right-0 lg:left-64 z-30">
                <div class="flex flex-col lg:flex-row items-center justify-between px-6 py-4">
                    <!-- Kiri: Judul & Salam -->
                    <div class="flex items-center mb-4 lg:mb-0">
                        <!-- Tombol Toggle Sidebar (Mobile) -->
                        <button @click="open = !open"
                            class="lg:hidden mr-4 p-2 rounded-lg bg-white/10 hover:bg-white/20 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            <h2 class="text-2xl font-bold flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-yellow-300" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m-9 4h18" />
                                </svg>
                                Selamat Datang, {{ auth()->user()->name }}!
                            </h2>
                            <p class="text-sm text-blue-100">Dashboard Khusus Admin — Desa Kala</p>
                        </div>
                    </div>

                    <!-- Kanan: Tanggal, Waktu, dan Logout -->
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-300 mr-3 opacity-80"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10m-11 5h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v7a2 2 0 002 2z" />
                            </svg>
                            @php
                                $now = now()->setTimezone('Asia/Makassar');
                            @endphp
                            <div class="text-right">
                                <div class="font-semibold">{{ $now->translatedFormat('l, d F Y') }}</div>
                                <small class="opacity-80">{{ $now->format('H:i') }} WITA</small>
                            </div>
                        </div>

                        <!-- Garis Pembatas -->
                        <div class="w-px h-10 bg-white/30"></div>

                        <!-- Profil & Logout -->
                        <div class="flex items-center">
                            <span class="mr-3 text-sm font-medium">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="flex items-center bg-white/20 hover:bg-white/30 text-white font-semibold text-sm px-4 py-2 rounded-full shadow-sm transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>


            <!-- Page Content -->
            <main class="flex-1 p-0 sm:p-6 mt-20 pt-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>