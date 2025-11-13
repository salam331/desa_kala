<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi masuk halus */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-emerald-50 to-white text-gray-800 py-20">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <!-- Hero Section -->
    <header class="relative bg-emerald-700 text-white">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1400&q=80"
                alt="Pemandangan Desa Kala" class="w-full h-full object-cover opacity-30">
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center py-20 px-4">
            <img src="https://cdn-icons-png.flaticon.com/512/535/535239.png" alt="Logo Desa Kala"
                class="w-24 h-24 mb-4 drop-shadow-lg">
            <h1 class="text-5xl font-extrabold mb-3 tracking-tight">Profil Desa Kala</h1>
            <p class="text-lg max-w-2xl">Menjelajahi sejarah, visi, misi, dan potensi Desa Kala sebagai desa yang maju,
                mandiri, dan berkelanjutan.</p>
        </div>
    </header>

    <!-- Konten -->
    <main class="container mx-auto px-4 py-12 space-y-12 fade-in">

        <!-- Sejarah Desa -->
        <section class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition">
            <h2 class="text-3xl font-bold mb-4 text-emerald-700 border-b-2 border-emerald-100 pb-2">Sejarah Desa</h2>
            @if($profilDesa)
                <p class="text-gray-700 leading-relaxed text-justify">{{ $profilDesa->sejarah_desa }}</p>
            @else
                <p class="text-gray-700 leading-relaxed text-justify">
                    Desa Kala berdiri sejak tahun 1950-an sebagai bagian dari upaya pembangunan nasional pasca kemerdekaan.
                    Awalnya, desa ini hanyalah pemukiman kecil di tengah hutan tropis. Berkat semangat gotong royong dan
                    kerja keras warganya, Desa Kala berkembang pesat menjadi pusat kegiatan ekonomi dan sosial yang penting.
                    Kini, desa ini dikenal dengan kehidupan masyarakat yang harmonis dan fokus pada pembangunan berkelanjutan
                    berbasis potensi lokal.
                </p>
            @endif
        </section>

        <!-- Visi & Misi -->
        <section class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition">
            <h2 class="text-3xl font-bold mb-6 text-emerald-700 border-b-2 border-emerald-100 pb-2">Visi & Misi</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-semibold mb-3 text-green-600">Visi</h3>
                    @if($profilDesa)
                        <p class="italic text-gray-700">{{ $profilDesa->visi }}</p>
                    @else
                        <p class="italic text-gray-700">
                            "Menjadi Desa Maju, Mandiri, dan Berkelanjutan yang Berbasis Potensi Lokal serta
                            Berorientasi pada Kesejahteraan Masyarakat."
                        </p>
                    @endif
                </div>
                <div>
                    <h3 class="text-2xl font-semibold mb-3 text-green-600">Misi</h3>
                    @if($profilDesa)
                        <p class="text-gray-700">{{ $profilDesa->misi }}</p>
                    @else
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan.</li>
                            <li>Mengembangkan potensi ekonomi lokal berbasis pertanian dan UMKM.</li>
                            <li>Membangun infrastruktur yang berkualitas dan berkelanjutan.</li>
                            <li>Melestarikan budaya serta menjaga kelestarian lingkungan.</li>
                            <li>Meningkatkan pelayanan publik yang transparan dan akuntabel.</li>
                        </ul>
                    @endif
                </div>
            </div>
        </section>

        <!-- Struktur Pemerintahan -->
        <section class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition">
            <h2 class="text-3xl font-bold mb-8 text-emerald-700 border-b-2 border-emerald-100 pb-2">Struktur
                Pemerintahan</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($strukturPemerintahan as $pejabat)
                    <div class="text-center">
                        <img src="{{ $pejabat->foto ? asset($pejabat->foto) : 'https://via.placeholder.com/150x200?text=' . urlencode($pejabat->jabatan) }}"
                            class="mx-auto mb-4 w-32 h-40 object-cover rounded-lg shadow-md hover:scale-105 transition"
                            alt="{{ $pejabat->nama }}">
                        <h3 class="font-semibold text-lg">{{ $pejabat->nama }}</h3>
                        <p class="text-gray-600 text-sm">{{ $pejabat->jabatan }}</p>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        <p>Belum ada data struktur pemerintahan.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Data Wilayah -->
        <section class="bg-white rounded-2xl shadow-md p-8 hover:shadow-lg transition">
            <h2 class="text-3xl font-bold mb-6 text-emerald-700 border-b-2 border-emerald-100 pb-2">Data Wilayah</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Peta -->
                <div>
                    <h3 class="text-2xl font-semibold mb-3 text-green-600">Peta Desa</h3>
                    <div class="overflow-hidden rounded-xl shadow-md">
                        @if($profilDesa && $profilDesa->peta_embed_display)
                            {!! $profilDesa->peta_embed_display !!}
                        @else
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.816666!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2cdbfd5e51e5e!2sJakarta!5e0!3m2!1sen!2sid!4v1690000000000"
                                width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        @endif
                    </div>
                </div>
                <!-- Informasi -->
                <div>
                    <h3 class="text-2xl font-semibold mb-3 text-green-600">Informasi Wilayah</h3>
                    <div class="bg-emerald-50 rounded-xl p-5 shadow-inner space-y-3 text-gray-700">
                        @if($profilDesa)
                            <div class="flex justify-between"><span class="font-medium">Luas Wilayah:</span><span>{{ $profilDesa->data_wilayah['luas_wilayah'] ?? '-' }} Ha</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Utara:</span><span>{{ $profilDesa->data_wilayah['batas_utara'] ?? '-' }}</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Selatan:</span><span>{{ $profilDesa->data_wilayah['batas_selatan'] ?? '-' }}</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Timur:</span><span>{{ $profilDesa->data_wilayah['batas_timur'] ?? '-' }}</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Barat:</span><span>{{ $profilDesa->data_wilayah['batas_barat'] ?? '-' }}</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah Dusun:</span><span>{{ $profilDesa->data_wilayah['jumlah_dusun'] ?? '-' }} Dusun</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah RT:</span><span>{{ $profilDesa->data_wilayah['jumlah_rt'] ?? '-' }} RT</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah RW:</span><span>{{ $profilDesa->data_wilayah['jumlah_rw'] ?? '-' }} RW</span></div>
                        @else
                            <div class="flex justify-between"><span class="font-medium">Luas Wilayah:</span><span>1.200 Ha</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Utara:</span><span>Desa Sebelah Utara</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Selatan:</span><span>Sungai Kala</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Timur:</span><span>Desa Timur Lestari</span></div>
                            <div class="flex justify-between"><span class="font-medium">Batas Barat:</span><span>Jalan Raya Kabupaten</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah Dusun:</span><span>5 Dusun</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah RT:</span><span>25 RT</span></div>
                            <div class="flex justify-between"><span class="font-medium">Jumlah RW:</span><span>5 RW</span></div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-emerald-700 text-white text-center py-6 mt-12">
        <p class="text-sm">&copy; 2025 Desa Kala. Semua hak dilindungi.</p>
    </footer>

</body>

</html>
