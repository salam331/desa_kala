<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Pengumuman - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Berita & Pengumuman Desa Kala</h1>

        <!-- Filter Kategori -->
        <div class="mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($kategoriList as $kat)
                    <a href="{{ route('berita.index', $kat !== 'semua' ? ['kategori' => $kat] : []) }}"
                       class="px-4 py-2 rounded-lg {{ $kategori === $kat || (!$kategori && $kat === 'semua') ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition-colors">
                        {{ ucfirst($kat) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Daftar Berita -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($berita as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    @php
                        $imgSrc = 'https://via.placeholder.com/400x250?text=No+Image';
                        if ($item->gambar) {
                            if (filter_var($item->gambar, FILTER_VALIDATE_URL)) {
                                // handle Google Drive share links for embedding
                                $parsed = parse_url($item->gambar);
                                $host = $parsed['host'] ?? '';
                                if (strpos($host, 'drive.google.com') !== false) {
                                    if (preg_match('#/file/d/([a-zA-Z0-9_-]+)#', $item->gambar, $m)) {
                                        $fileId = $m[1];
                                        $imgSrc = 'https://drive.google.com/uc?export=view&id=' . $fileId;
                                    } elseif (isset($parsed['query'])) {
                                        parse_str($parsed['query'], $q);
                                        if (!empty($q['id'])) {
                                            $imgSrc = 'https://drive.google.com/uc?export=view&id=' . $q['id'];
                                        } else {
                                            $imgSrc = $item->gambar;
                                        }
                                    } else {
                                        $imgSrc = $item->gambar;
                                    }
                                } else {
                                    $imgSrc = $item->gambar;
                                }
                            } else {
                                $imgSrc = asset($item->gambar);
                            }
                        }
                    @endphp
                    <img src="{{ $imgSrc }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-blue-600 font-medium">{{ ucfirst($item->kategori) }}</span>
                            <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($item->tanggal)) }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $item->judul }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->ringkasan }}</p>
                        <a href="{{ route('berita.show', $item->id) }}"
                           class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(empty($berita))
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada berita dalam kategori ini.</p>
            </div>
        @endif
    </div>
</body>
</html>
