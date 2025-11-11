<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potensi Desa - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Potensi Desa Kala</h1>

        <!-- Informasi Umum -->
        <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-8 rounded-r-lg">
            <h2 class="text-xl font-semibold mb-2 text-green-800">Potensi Unggulan Desa</h2>
            <p class="text-green-700">
                Desa Kala memiliki berbagai potensi unggulan di bidang pertanian, peternakan, UMKM, wisata, dan sumber daya alam.
                Potensi ini dikelola secara berkelanjutan untuk meningkatkan kesejahteraan masyarakat dan menjadi daya tarik wisata.
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('potensi.index') }}"
                   class="px-4 py-2 rounded-lg bg-green-600 text-white transition-colors">
                    Semua Potensi
                </a>
                <a href="{{ route('potensi.index') }}?kategori=pertanian"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Pertanian
                </a>
                <a href="{{ route('potensi.index') }}?kategori=peternakan"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Peternakan
                </a>
                <a href="{{ route('potensi.index') }}?kategori=umkm"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    UMKM
                </a>
                <a href="{{ route('potensi.index') }}?kategori=wisata"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Wisata
                </a>
                <a href="{{ route('potensi.index') }}?kategori=sumber_daya_alam"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    SDA
                </a>
            </div>
        </div>

        <!-- Daftar Potensi -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($potensi as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-blue-600 font-medium bg-blue-100 px-2 py-1 rounded-full">
                                {{ ucfirst(str_replace('_', ' ', $item['kategori'])) }}
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $item['nama'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item['deskripsi'] }}</p>

                        <!-- Detail Button -->
                        <button onclick="toggleDetail({{ $item['id'] }})"
                                class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors mb-2">
                            Lihat Detail
                        </button>
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Hubungi Pengelola
                        </button>
                    </div>

                    <!-- Detail Panel (Hidden by default) -->
                    <div id="detail-{{ $item['id'] }}" class="hidden p-6 bg-gray-50 border-t">
                        <!-- Detail Deskripsi -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Detail:</h4>
                            <p class="text-sm text-gray-600">{{ $item['detail'] }}</p>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Kontak:</span>
                                <span>{{ $item['kontak'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Telepon:</span>
                                <span>{{ $item['telepon'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Lokasi:</span>
                                <span>{{ $item['lokasi'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(empty($potensi))
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada potensi dalam kategori ini.</p>
            </div>
        @endif

        <!-- Statistik Potensi -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-6 text-gray-800">Statistik Potensi Desa</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">800</div>
                    <div class="text-sm text-gray-600">Hektar Lahan Pertanian</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">200</div>
                    <div class="text-sm text-gray-600">Ekor Ternak Sapi</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600 mb-2">50</div>
                    <div class="text-sm text-gray-600">UMKM Terdaftar</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">150</div>
                    <div class="text-sm text-gray-600">Hektar Hutan Lindung</div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-8 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Berkontribusi untuk Desa Kala</h2>
            <p class="mb-6">Mari bersama-sama mengembangkan potensi desa untuk kesejahteraan masyarakat</p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="bg-white text-green-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Investasi
                </button>
                <button class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Kerjasama
                </button>
                <button class="bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Wisata
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            const detail = document.getElementById('detail-' + id);
            detail.classList.toggle('hidden');
        }
    </script>
</body>
</html>
