<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $welcomeElements['navbar']->where('element_key', 'village_name')->first()?->content ?? 'Desa Kala' }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <!-- Navigation -->
    @include('layouts.public-navigation')

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen flex items-center"
        style="background-image: url('{{ $welcomeElements['hero']->where('element_key', 'background_image')->first()?->content ?? 'https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=1920&q=80' }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                {{ $welcomeElements['hero']->where('element_key', 'title')->first()?->content ?? 'Selamat Datang di Desa Kala' }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                {{ $welcomeElements['hero']->where('element_key', 'description')->first()?->content ?? 'Pusat informasi, kegiatan, dan potensi Desa Kala yang asri dan penuh budaya.' }}
            </p>
            <a href="{{ $welcomeElements['hero']->where('element_key', 'button_link')->first()?->content ?? '#profil' }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                {{ $welcomeElements['hero']->where('element_key', 'button_text')->first()?->content ?? 'Jelajahi Sekarang' }}
            </a>
        </div>
    </section>

    <!-- Profile Section -->
    <section id="profil" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ $welcomeElements['profile']->where('element_key', 'title')->first()?->content ?? 'Profil Desa' }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ $welcomeElements['profile']->where('element_key', 'description')->first()?->content ?? 'Mengenal lebih dekat Desa Kala, pesona alam dan masyarakatnya.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Location Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $welcomeElements['location']->where('element_key', 'title')->first()?->content ?? 'Letak Geografis' }}
                    </h3>
                    <p class="text-gray-600">
                        {{ $welcomeElements['location']->where('element_key', 'description')->first()?->content ?? 'Desa Kala terletak di lereng pegunungan dengan udara sejuk dan panorama alam yang menakjubkan.' }}
                    </p>
                </div>

                <!-- Agriculture Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $welcomeElements['agriculture']->where('element_key', 'title')->first()?->content ?? 'Potensi Pertanian' }}
                    </h3>
                    <p class="text-gray-600">
                        {{ $welcomeElements['agriculture']->where('element_key', 'description')->first()?->content ?? 'Pertanian menjadi sektor utama dengan hasil bumi unggulan seperti sayuran segar dan buah tropis.' }}
                    </p>
                </div>

                <!-- Culture Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $welcomeElements['culture']->where('element_key', 'title')->first()?->content ?? 'Budaya & Tradisi' }}
                    </h3>
                    <p class="text-gray-600">
                        {{ $welcomeElements['culture']->where('element_key', 'description')->first()?->content ?? 'Tradisi gotong royong dan kearifan lokal tetap terjaga, menciptakan masyarakat yang harmonis.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-300">
                {{ $welcomeElements['footer']->where('element_key', 'text')->first()?->content ?? '© 2025 Desa Kala. Seluruh hak cipta dilindungi.' }}
            </p>
        </div>
    </footer>
</body>

</html>
