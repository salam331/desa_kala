<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Desa - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gallery-item {
            transition: transform 0.3s ease;
        }
        .gallery-item:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Galeri Desa Kala</h1>

        <!-- Informasi Umum -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg">
            <h2 class="text-xl font-semibold mb-2 text-blue-800">Koleksi Foto Desa</h2>
            <p class="text-blue-700">
                Dokumentasi kegiatan, pembangunan, event, dan keindahan panorama Desa Kala.
                Galeri ini menampilkan berbagai momen penting dalam perkembangan desa kita.
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('galeri.index') }}"
                   class="px-4 py-2 rounded-lg bg-green-600 text-white transition-colors">
                    Semua Album
                </a>
                <a href="{{ route('galeri.index') }}?kategori=kegiatan"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Kegiatan Desa
                </a>
                <a href="{{ route('galeri.index') }}?kategori=pembangunan"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Pembangunan
                </a>
                <a href="{{ route('galeri.index') }}?kategori=event"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Event & Festival
                </a>
                <a href="{{ route('galeri.index') }}?kategori=panorama"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Panorama
                </a>
            </div>
        </div>

        <!-- Galeri Album -->
        @foreach($galeri as $album)
            <div class="mb-12">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $album['album'] }}</h2>
                    <p class="text-gray-600">{{ $album['deskripsi'] }}</p>
                </div>

                <!-- Grid Foto -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($album['foto'] as $foto)
                        <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden cursor-pointer"
                             onclick="openModal({{ $foto['id'] }}, '{{ $foto['url'] }}', '{{ $foto['judul'] }}', '{{ $foto['deskripsi'] }}', '{{ $foto['tanggal'] }}')">
                            <img src="{{ $foto['url'] }}" alt="{{ $foto['judul'] }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-2">{{ $foto['judul'] }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $foto['deskripsi'] }}</p>
                                <p class="text-xs text-gray-500">{{ date('d M Y', strtotime($foto['tanggal'])) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if(empty($galeri))
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada foto dalam kategori ini.</p>
            </div>
        @endif

        <!-- Statistik Galeri -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Statistik Galeri</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">16</div>
                    <div class="text-sm text-gray-600">Total Foto</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
                    <div class="text-sm text-gray-600">Album Kategori</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600 mb-2">2023</div>
                    <div class="text-sm text-gray-600">Tahun Dokumentasi</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">4</div>
                    <div class="text-sm text-gray-600">Foto per Album</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk melihat foto besar -->
    <div id="photoModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 id="modalTitle" class="text-xl font-semibold"></h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[60vh] object-contain">
                <div class="mt-4">
                    <p id="modalDescription" class="text-gray-600 mb-2"></p>
                    <p id="modalDate" class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, url, title, description, date) {
            document.getElementById('modalImage').src = url;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalDate').textContent = 'Tanggal: ' + new Date(date).toLocaleDateString('id-ID');
            document.getElementById('photoModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('photoModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('photoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
