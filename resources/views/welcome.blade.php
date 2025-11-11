<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $welcomeElements['navbar']->where('element_key', 'village_name')->first()?->content ?? 'Desa Kala' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        /* animasi muncul lembut */
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="antialiased font-[Figtree] bg-gradient-to-b from-emerald-50 to-white text-gray-800 py-20">

    <!-- 🔰 Navigation -->
    @include('layouts.public-navigation')

    <!-- 🌄 Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center scale-110 animate-slow-zoom"
            style="background-image: url('{{ $welcomeElements['hero']->where('element_key', 'background_image')->first()?->content ?? 'https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=1920&q=80' }}');">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70 backdrop-blur-[2px]"></div>

        <div class="relative z-10 text-center text-white px-4 fade-up">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg">
                {{ $welcomeElements['hero']->where('element_key', 'title')->first()?->content ?? 'Selamat Datang di Desa Kala' }}
            </h1>
            <p class="text-lg md:text-2xl mb-8 text-gray-100 max-w-2xl mx-auto">
                {{ $welcomeElements['hero']->where('element_key', 'description')->first()?->content ?? 'Pusat informasi, kegiatan, dan potensi Desa Kala yang asri dan penuh budaya.' }}
            </p>
            <a href="{{ $welcomeElements['hero']->where('element_key', 'button_link')->first()?->content ?? '#profil' }}"
                class="inline-block bg-gradient-to-r from-emerald-500 to-emerald-700 hover:from-emerald-600 hover:to-emerald-800 text-white font-semibold py-3 px-10 rounded-full shadow-lg hover:shadow-emerald-500/30 transform hover:scale-105 transition duration-300">
                {{ $welcomeElements['hero']->where('element_key', 'button_text')->first()?->content ?? 'Jelajahi Sekarang' }}
            </a>
        </div>
    </section>

    <!-- 🏡 Profil Desa -->
    <section id="profil" class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-50 to-white opacity-70"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 fade-up">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-emerald-700 mb-4">
                    {{ $welcomeElements['profile']->where('element_key', 'title')->first()?->content ?? 'Profil Desa Kala' }}
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ $welcomeElements['profile']->where('element_key', 'description')->first()?->content ?? 'Mengenal lebih dekat Desa Kala, pesona alam dan masyarakatnya.' }}
                </p>
                <div class="mt-4 h-1 w-24 bg-gradient-to-r from-emerald-400 to-emerald-700 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Kartu -->
                @php
                    $cards = [
                        [
                            'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z',
                            'color' => 'emerald',
                            'title' => 'Letak Geografis',
                            'desc' =>
                                'Desa Kala terletak di lereng pegunungan dengan udara sejuk dan panorama alam yang menakjubkan.',
                        ],
                        [
                            'icon' =>
                                'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
                            'color' => 'yellow',
                            'title' => 'Potensi Pertanian',
                            'desc' =>
                                'Pertanian menjadi sektor utama dengan hasil bumi unggulan seperti sayuran segar dan buah tropis.',
                        ],
                        [
                            'icon' =>
                                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                            'color' => 'purple',
                            'title' => 'Budaya & Tradisi',
                            'desc' =>
                                'Tradisi gotong royong dan kearifan lokal tetap terjaga, menciptakan masyarakat yang harmonis.',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div
                        class="bg-white p-8 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 hover:bg-gradient-to-br hover:from-white hover:to-emerald-50 relative overflow-hidden group">
                        <div
                            class="w-14 h-14 flex items-center justify-center bg-{{ $card['color'] }}-100 rounded-xl mb-5 group-hover:scale-110 transition duration-300">
                            <svg class="w-7 h-7 text-{{ $card['color'] }}-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $card['icon'] }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $card['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $card['desc'] }}</p>
                        <div
                            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ⚙️ Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10 relative">
        <div
            class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-500 to-emerald-700 opacity-70"></div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <p class="text-sm">
                {{ $welcomeElements['footer']->where('element_key', 'text')->first()?->content ?? '© 2025 Desa Kala. Seluruh hak cipta dilindungi.' }}
            </p>
        </div>
    </footer>

    <!-- ✨ Animasi scroll -->
    <script>
        const fadeElements = document.querySelectorAll('.fade-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.2 });

        fadeElements.forEach(el => observer.observe(el));
    </script>
</body>

</html>
