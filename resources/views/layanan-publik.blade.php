<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Publik - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter Layanan</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('layanan.index') }}"
                       class="px-6 py-3 rounded-lg font-medium {{ request('kategori') == null ? 'bg-green-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all duration-200">
                        <i class="fas fa-th-list mr-2"></i>Semua Layanan
                    </a>
                    <a href="{{ route('layanan.index') }}?kategori=administrasi"
                       class="px-6 py-3 rounded-lg font-medium {{ request('kategori') === 'administrasi' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all duration-200">
                        <i class="fas fa-file-alt mr-2"></i>Administrasi
                    </a>
                    <a href="{{ route('layanan.index') }}?kategori=perizinan"
                       class="px-6 py-3 rounded-lg font-medium {{ request('kategori') === 'perizinan' ? 'bg-green-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all duration-200">
                        <i class="fas fa-clipboard-check mr-2"></i>Perizinan
                    </a>
                </div>

                <!-- Current Filter Info -->
                @if(request('kategori'))
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600">
                            Menampilkan layanan kategori:
                            <span class="font-semibold text-gray-800">
                                {{ request('kategori') === 'administrasi' ? 'Administrasi' : 'Perizinan' }}
                            </span>
                            <a href="{{ route('layanan.index') }}" class="text-blue-600 hover:text-blue-800 ml-2">
                                <i class="fas fa-times"></i> Hapus Filter
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Daftar Layanan -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($layanan as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="bg-gradient-to-r from-green-500 to-blue-500 p-4">
                        <h3 class="text-xl font-semibold text-white">{{ $item->nama }}</h3>
                        <span class="inline-block bg-white bg-opacity-20 text-white px-2 py-1 rounded-full text-sm mt-2">
                            {{ ucfirst($item->kategori) }}
                        </span>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">{{ $item->deskripsi }}</p>

                        <!-- Informasi Singkat -->
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Waktu Proses:</span>
                                <span>{{ $item->waktu_proses }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="font-medium">Biaya:</span>
                                <span class="text-green-600 font-semibold">{{ $item->biaya }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2 mb-4">
                            <button onclick="toggleDetail({{ $item->id }})"
                                    class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                Lihat Detail
                            </button>
                            @if($item->gambar)
                                <button onclick="openImageModal('{{ asset($item->gambar) }}', '{{ $item->nama }}')"
                                        class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition-colors"
                                        title="Lihat Gambar">
                                    <i class="fas fa-eye"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Detail Panel (Hidden by default) -->
                    <div id="detail-{{ $item->id }}" class="hidden p-6 bg-gray-50 border-t">
                        <!-- Prosedur -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Prosedur:</h4>
                            <ol class="list-decimal list-inside text-sm text-gray-600 space-y-1">
                                @foreach($item->prosedur as $prosedur)
                                    <li>{{ $prosedur }}</li>
                                @endforeach
                            </ol>
                        </div>

                        <!-- Syarat -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Syarat Dokumen:</h4>
                            <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                @foreach($item->syarat as $syarat)
                                    <li>{{ $syarat }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2 text-gray-800">Kontak:</h4>
                            <p class="text-sm text-gray-600">{{ $item->kontak }}</p>
                        </div>

                        <!-- Ajukan Online Button -->
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Ajukan Online
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak ada layanan ditemukan</h3>
                        <p class="text-gray-500 mb-4">
                            @if(request('kategori'))
                                Tidak ada layanan dalam kategori "{{ request('kategori') === 'administrasi' ? 'Administrasi' : 'Perizinan' }}".
                            @else
                                Belum ada layanan yang tersedia saat ini.
                            @endif
                        </p>
                        @if(request('kategori'))
                            <a href="{{ route('layanan.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                <i class="fas fa-arrow-left mr-1"></i>Lihat Semua Layanan
                            </a>
                        @endif
                    </div>
                </div>
            @endforelse
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

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl max-h-full overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-800"></h3>
                <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-4">
                <img id="modalImage" src="" alt="" class="max-w-full max-h-96 object-contain mx-auto">
            </div>
        </div>
    </div>

    <script>
        function toggleDetail(id) {
            const detail = document.getElementById('detail-' + id);
            detail.classList.toggle('hidden');
        }

        function openImageModal(imageSrc, title) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</body>
</html>
