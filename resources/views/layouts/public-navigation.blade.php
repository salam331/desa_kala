<nav class="bg-white shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo dan Nama Desa -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Desa" class="h-10 w-10 rounded-full">
                <a href="/" class="text-xl font-bold text-emerald-700 hover:text-emerald-800 transition">
                    {{ $welcomeElements['navbar']->where('element_key', 'village_name')->first()?->content ?? 'Desa Kala' }}
                </a>
            </div>

            <!-- Menu Utama (Desktop) -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="/profil-desa"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_profil')->first()?->content ?? 'Profil Desa' }}
                </a>
                <a href="{{ route('berita.index') }}"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_berita')->first()?->content ?? 'Berita' }}
                </a>
                <a href="{{ route('layanan.index') }}"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_layanan')->first()?->content ?? 'Layanan Publik' }}
                </a>
                <a href="{{ route('potensi.index') }}"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_potensi')->first()?->content ?? 'Potensi Desa' }}
                </a>
                <a href="{{ route('galeri.index') }}"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_galeri')->first()?->content ?? 'Galeri Desa' }}
                </a>
                <a href="{{ route('kontak.index') }}"
                    class="text-gray-700 hover:text-emerald-700 px-3 py-2 rounded-md text-sm font-medium">
                    {{ $welcomeElements['navbar']->where('element_key', 'menu_kontak')->first()?->content ?? 'Kontak & Pengaduan' }}
                </a>
                {{-- button login --}}
                <div>
                    <a href="{{ route('login') }}"
                        class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-emerald-700 transition">
                        {{ $welcomeElements['navbar']->where('element_key', 'button_login')->first()?->content ?? 'Login' }}
                    </a>
                </div>
            </div>

            <!-- Tombol Mobile -->
            <div class="flex items-center md:hidden">
                <button id="menu-toggle" class="text-gray-700 hover:text-emerald-700 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <a href="/profil-desa"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Profil Desa</a>
        <a href="{{ route('berita.index') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Berita</a>
        <a href="{{ route('layanan.index') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Layanan Publik</a>
        <a href="{{ route('potensi.index') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Potensi Desa</a>
        <a href="{{ route('galeri.index') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Galeri Desa</a>
        <a href="{{ route('kontak.index') }}"
            class="block px-4 py-2 text-gray-700 hover:bg-emerald-50 hover:text-emerald-700">Kontak & Pengaduan</a>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a2e0a1e6f3.js" crossorigin="anonymous"></script>

    <!-- Script Toggle -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</nav>
