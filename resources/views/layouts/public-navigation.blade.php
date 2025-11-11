<nav id="navbar"
    class="fixed top-0 left-0 w-full z-50 bg-white/40 backdrop-blur-lg border-b border-emerald-100 shadow-md transition-all duration-500">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex justify-between items-center h-20">

            <!-- 🔰 Logo & Nama Desa -->
            <div class="flex items-center space-x-3 group">
                <div
                    class="relative bg-gradient-to-br from-emerald-500 to-emerald-700 p-[2px] rounded-full transition-all duration-300 group-hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Desa"
                        class="h-10 w-10 rounded-full border-2 border-white shadow-md">
                </div>
                <a href="/" class="text-2xl font-bold text-emerald-700 hover:text-emerald-800 transition duration-300">
                    {{ $welcomeElements['navbar']->where('element_key', 'village_name')->first()?->content ?? 'Desa Kala' }}
                </a>
            </div>

            <!-- 🌐 Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                @php
                    $menus = [
                        ['route' => '/', 'key' => 'menu_home', 'default' => 'Beranda'],
                        ['route' => '/profil-desa', 'key' => 'menu_profil', 'default' => 'Profil Desa'],
                        ['route' => route('berita.index'), 'key' => 'menu_berita', 'default' => 'Berita'],
                        ['route' => route('layanan.index'), 'key' => 'menu_layanan', 'default' => 'Layanan Publik'],
                        ['route' => route('potensi.index'), 'key' => 'menu_potensi', 'default' => 'Potensi Desa'],
                        ['route' => route('galeri.index'), 'key' => 'menu_galeri', 'default' => 'Galeri Desa'],
                        ['route' => route('kontak.index'), 'key' => 'menu_kontak', 'default' => 'Kontak & Pengaduan'],
                    ];
                    $current = request()->path();
                @endphp

                @foreach ($menus as $menu)
                    @php
                        $isActive =
                            trim($current, '/') === trim(parse_url($menu['route'], PHP_URL_PATH), '/')
                            ? 'text-emerald-700 font-semibold'
                            : 'text-gray-700';
                    @endphp
                    <a href="{{ $menu['route'] }}"
                        class="relative {{ $isActive }} hover:text-emerald-700 transition duration-300 font-medium text-[15px] px-2 py-2 group">
                        {{ $welcomeElements['navbar']->where('element_key', $menu['key'])->first()?->content ?? $menu['default'] }}
                        <span
                            class="absolute left-0 bottom-0 w-0 h-[2px] bg-gradient-to-r from-emerald-500 to-emerald-700 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                @endforeach

                <!-- 🔒 Tombol Login -->
                <a href="{{ route('login') }}"
                    class="ml-4 px-5 py-2.5 rounded-full text-white font-medium bg-gradient-to-r from-emerald-600 to-emerald-700 shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300">
                    <i class="fas fa-user mr-2"></i>
                    {{ $welcomeElements['navbar']->where('element_key', 'button_login')->first()?->content ?? 'Login' }}
                </a>
            </div>

            <!-- 📱 Tombol Menu (Mobile) -->
            <div class="flex items-center md:hidden">
                <button id="menu-toggle"
                    class="text-gray-700 hover:text-emerald-700 focus:outline-none transition duration-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- 📋 Menu Mobile -->
    <div id="mobile-menu"
        class="hidden md:hidden bg-white/90 backdrop-blur-md border-t border-emerald-100 shadow-lg transition-all duration-500">
        @foreach ($menus as $menu)
            <a href="{{ $menu['route'] }}"
                class="block px-6 py-3 text-gray-700 font-medium hover:bg-emerald-50 hover:text-emerald-700 border-b border-gray-100 transition-all duration-300">
                <i class="fas fa-angle-right mr-2 text-emerald-600"></i>
                {{ $welcomeElements['navbar']->where('element_key', $menu['key'])->first()?->content ?? $menu['default'] }}
            </a>
        @endforeach
        <a href="{{ route('login') }}"
            class="block px-6 py-3 text-center font-semibold text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 shadow-md hover:shadow-lg transition-all duration-300">
            <i class="fas fa-lock mr-2"></i> Login
        </a>
    </div>

    <!-- 🧩 Font Awesome -->
    <script src="https://kit.fontawesome.com/a2e0a1e6f3.js" crossorigin="anonymous"></script>

    <!-- ⚙️ Script Toggle & Scroll Effect -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const navbar = document.getElementById('navbar');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuToggle.innerHTML = mobileMenu.classList.contains('hidden')
                ? '<i class="fas fa-bars text-2xl"></i>'
                : '<i class="fas fa-times text-2xl"></i>';
        });

        // Efek dinamis saat scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 15) {
                navbar.classList.add('bg-white', 'shadow-lg', 'backdrop-blur-none', 'border-emerald-200');
                navbar.classList.remove('bg-white/40', 'backdrop-blur-lg');
            } else {
                navbar.classList.remove('bg-white', 'shadow-lg', 'backdrop-blur-none');
                navbar.classList.add('bg-white/40', 'backdrop-blur-lg');
            }
        });
    </script>
</nav>