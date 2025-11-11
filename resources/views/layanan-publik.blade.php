<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Publik - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-20">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Layanan Publik Desa Kala</h1>

        <!-- Informasi Umum -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg">
            <h2 class="text-xl font-semibold mb-2 text-blue-800">Informasi Layanan</h2>
            <p class="text-blue-700">
                Kantor Desa Kala menyediakan berbagai layanan administrasi dan perizinan untuk memudahkan masyarakat.
                Layanan dapat diakses selama jam kerja (Senin-Jumat, 08.00-15.00 WIB).
                Untuk informasi lebih lanjut, silakan hubungi kantor desa.
            </p>
        </div>

        <!-- Filter Kategori -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('layanan.index') }}"
                   class="px-4 py-2 rounded-lg bg-green-600 text-white transition-colors">
                    Semua Layanan
                </a>
                <a href="{{ route('layanan.index') }}?kategori=administrasi"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Administrasi
                </a>
                <a href="{{ route('layanan.index') }}?kategori=perizinan"
                   class="px-4 py-2 rounded-lg bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    Perizinan
                </a>
            </div>
        </div>

        <!-- Daftar Layanan -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($layanan as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-green-500 to-blue-500 p-4">
                        <h3 class="text-xl font-semibold text-white">{{ $item['nama'] }}</h3>
                        <span class="inline-block bg-white bg-opacity-20 text-white px-2 py-1 rounded-full text-sm mt-2">
                            {{ ucfirst($item['kategori']) }}
                        </span>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">{{ $item['deskripsi'] }}</p>

                        <!-- Informasi Singkat -->
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Waktu Proses:</span>
                                <span>{{ $item['waktu_proses'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Biaya:</span>
                                <span class="text-green-600 font-semibold">{{ $item['biaya'] }}</span>
                            </div>
                        </div>

                        <!-- Detail Button -->
                        <button onclick="toggleDetail({{ $item['id'] }})"
                                class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            Lihat Detail
                        </button>
                    </div>

                    <!-- Detail Panel (Hidden by default) -->
                    <div id="detail-{{ $item['id'] }}" class="hidden p-6 bg-gray-50 border-t">
                        <!-- Prosedur -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Prosedur:</h4>
                            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-1">
                                @foreach($item['prosedur'] as $prosedur)
                                    <li>{{ $prosedur }}</li>
                                @endforeach
                            </ol>
                        </div>

                        <!-- Syarat -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Syarat Dokumen:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                @foreach($item['syarat'] as $syarat)
                                    <li>{{ $syarat }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Kontak:</h4>
                            <p class="text-sm text-gray-600">{{ $item['kontak'] }}</p>
                        </div>

                        <!-- Ajukan Online Button -->
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Ajukan Online
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Informasi Kontak -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Informasi Kontak</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-2">Kantor Desa Kala</h3>
                    <p class="text-gray-600">Jl. Raya Desa Kala No. 123<br>
                    Desa Kala, Kecamatan Kala<br>
                    Kabupaten Kala, Provinsi Jawa Barat</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Jam Operasional</h3>
                    <p class="text-gray-600">Senin - Jumat: 08.00 - 15.00 WIB<br>
                    Sabtu: 08.00 - 12.00 WIB<br>
                    Minggu & Hari Libur: Tutup</p>
                </div>
            </div>
            <div class="mt-4">
                <p class="text-gray-600">
                    <strong>Telepon:</strong> (021) 123-4567<br>
                    <strong>Email:</strong> info@desakala.go.id
                </p>
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
