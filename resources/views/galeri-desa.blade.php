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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 py-20">

    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Galeri Desa Kala</h1>

        <!-- Info Umum -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg">
            <h2 class="text-xl font-semibold mb-2 text-blue-800">Koleksi Foto Desa</h2>
            <p class="text-blue-700">
                Dokumentasi kegiatan, pembangunan, event, dan keindahan panorama Desa Kala.
                Galeri ini menampilkan berbagai momen penting dalam perkembangan desa kita.
            </p>
        </div>

        <!-- Filter -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($kategoriList as $kategori)
                    <a href="{{ route('galeri.index', $kategori !== 'semua' ? ['kategori' => $kategori] : []) }}"
                       class="px-4 py-2 rounded-lg {{ request('kategori') === $kategori || ($kategori === 'semua' && !request('kategori')) ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition-colors capitalize">
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Galeri (Grid) -->
        @php $filteredGaleri = array_filter($galeri, fn($g) => count($g['foto']) > 0); @endphp

        @if(count($filteredGaleri))
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($filteredGaleri as $group)
                    @php $firstPhoto = $group['foto'][0]; @endphp
                    <a href="{{ route('galeri.show', $group['id']) }}" class="gallery-item block bg-white rounded-lg shadow-md overflow-hidden relative">
                        <img src="{{ $firstPhoto['url'] }}" alt="{{ $firstPhoto['judul'] }}" class="w-full h-48 object-cover">
                        @if(count($group['foto']) > 1)
                            <div class="absolute top-2 right-2 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-sm">
                                +{{ count($group['foto']) - 1 }} more
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">{{ $group['judul'] }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $group['deskripsi'] }}</p>
                            <p class="text-xs text-gray-500">{{ count($group['foto']) }} foto</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada foto dalam kategori ini.</p>
            </div>
        @endif

        <!-- Statistik Galeri -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Statistik Galeri</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">
                        {{ collect($filteredGaleri)->sum(fn($g) => count($g['foto'])) }}
                    </div>
                    <div class="text-sm text-gray-600">Total Foto</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">
                        {{ count(array_unique(array_column($filteredGaleri, 'kategori'))) }}
                    </div>
                    <div class="text-sm text-gray-600">Kategori</div>
                </div>
                <div class="text-center">
                    @php
                        $allDates = [];
                        foreach ($filteredGaleri as $g) {
                            foreach ($g['foto'] as $f) {
                                $allDates[] = $f['tanggal'];
                            }
                        }
                        $latestYear = !empty($allDates) ? \Carbon\Carbon::parse(max($allDates))->year : '-';
                    @endphp
                    <div class="text-3xl font-bold text-orange-600 mb-2">{{ $latestYear }}</div>
                    <div class="text-sm text-gray-600">Tahun Terbaru</div>
                </div>
                <div class="text-center">
                    @php
                        $totalGroups = count($filteredGaleri);
                        $totalPhotos = collect($filteredGaleri)->sum(fn($g) => count($g['foto']));
                        $avg = $totalGroups > 0 ? round($totalPhotos / $totalGroups, 1) : 0;
                    @endphp
                    <div class="text-3xl font-bold text-purple-600 mb-2">{{ $avg }}</div>
                    <div class="text-sm text-gray-600">Rata-rata Foto per Judul</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Album -->
    <div id="albumModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-6xl w-full max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 id="albumModalTitle" class="text-xl font-semibold"></h3>
                <button onclick="closeAlbumModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-y-auto max-h-[80vh]">
                <div id="albumPhotos" class="grid md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
            </div>
        </div>
    </div>

    <script>
        function openAlbumModal(albumTitle, photos) {
            document.getElementById('albumModalTitle').textContent = albumTitle;
            const albumPhotosContainer = document.getElementById('albumPhotos');
            albumPhotosContainer.innerHTML = '';

            photos.forEach(function(photo) {
                const photoDiv = document.createElement('div');
                photoDiv.className = 'bg-white rounded-lg shadow-md overflow-hidden';
                photoDiv.innerHTML = `
                    <img src="${photo.url}" alt="${photo.judul}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">${photo.judul}</h4>
                        <p class="text-sm text-gray-600 mb-2">${photo.deskripsi}</p>
                        <p class="text-xs text-gray-500">${new Date(photo.tanggal).toLocaleDateString('id-ID')}</p>
                    </div>
                `;
                albumPhotosContainer.appendChild(photoDiv);
            });

            document.getElementById('albumModal').classList.remove('hidden');
        }

        function closeAlbumModal() {
            document.getElementById('albumModal').classList.add('hidden');
        }

        document.getElementById('albumModal').addEventListener('click', function(e) {
            if (e.target === this) closeAlbumModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeAlbumModal();
        });
    </script>
</body>
</html>
