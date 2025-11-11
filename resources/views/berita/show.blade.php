<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$berita->judul}} - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-6">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="/" class="hover:text-green-600">Beranda</a></li>
                    <li>/</li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-green-600">Berita</a></li>
                    <li>/</li>
                    <li class="text-gray-900">{{ $berita->judul }}</li>
                </ol>
            </nav>

            <!-- Article -->
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header -->
                <header class="p-6 border-b">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-blue-600 font-medium bg-blue-100 px-2 py-1 rounded-full">
                            {{ ucfirst($berita->kategori) }}
                        </span>
                        <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($berita->tanggal)) }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $berita->judul }}</h1>
                    <p class="text-lg text-gray-600">{{ $berita->ringkasan }}</p>
                </header>

                <!-- Image -->
                @php
                    $imgSrc = 'https://via.placeholder.com/800x400?text=No+Image';
                    if ($berita->gambar) {
                        if (filter_var($berita->gambar, FILTER_VALIDATE_URL)) {
                            // handle Google Drive share links for embedding
                            $parsed = parse_url($berita->gambar);
                            $host = $parsed['host'] ?? '';
                            if (strpos($host, 'drive.google.com') !== false) {
                                if (preg_match('#/file/d/([a-zA-Z0-9_-]+)#', $berita->gambar, $m)) {
                                    $fileId = $m[1];
                                    $imgSrc = 'https://drive.google.com/uc?export=view&id=' . $fileId;
                                } elseif (isset($parsed['query'])) {
                                    parse_str($parsed['query'], $q);
                                    if (!empty($q['id'])) {
                                        $imgSrc = 'https://drive.google.com/uc?export=view&id=' . $q['id'];
                                    } else {
                                        $imgSrc = $berita->gambar;
                                    }
                                } else {
                                    $imgSrc = $berita->gambar;
                                }
                            } else {
                                $imgSrc = $berita->gambar;
                            }
                        } else {
                            $imgSrc = asset($berita->gambar);
                        }
                    }
                @endphp
                <div class="p-6">
                    <img src="{{ $imgSrc }}" alt="{{ $berita->judul }}" class="w-full h-64 md:h-96 object-cover rounded-lg mb-6">
                </div>

                <!-- Content -->
                <div class="px-6 pb-6">
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($berita->isi)) !!}
                    </div>
                </div>

                <!-- Footer -->
                <footer class="px-6 py-4 bg-gray-50 border-t">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Dipublikasikan pada {{ date('d F Y', strtotime($berita->tanggal)) }}
                        </div>
                        <a href="{{ route('berita.index') }}"
                           class="text-green-600 hover:text-green-700 font-medium">
                            ← Kembali ke Berita
                        </a>
                    </div>
                </footer>
            </article>

            <!-- Related News -->
            @if($relatedBerita->count() > 0)
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedBerita as $related)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                @php
                                    $relatedImgSrc = 'https://via.placeholder.com/400x250?text=No+Image';
                                    if ($related->gambar) {
                                        if (filter_var($related->gambar, FILTER_VALIDATE_URL)) {
                                            $parsed = parse_url($related->gambar);
                                            $host = $parsed['host'] ?? '';
                                            if (strpos($host, 'drive.google.com') !== false) {
                                                if (preg_match('#/file/d/([a-zA-Z0-9_-]+)#', $related->gambar, $m)) {
                                                    $fileId = $m[1];
                                                    $relatedImgSrc = 'https://drive.google.com/uc?export=view&id=' . $fileId;
                                                } elseif (isset($parsed['query'])) {
                                                    parse_str($parsed['query'], $q);
                                                    if (!empty($q['id'])) {
                                                        $relatedImgSrc = 'https://drive.google.com/uc?export=view&id=' . $q['id'];
                                                    } else {
                                                        $relatedImgSrc = $related->gambar;
                                                    }
                                                } else {
                                                    $relatedImgSrc = $related->gambar;
                                                }
                                            } else {
                                                $relatedImgSrc = $related->gambar;
                                            }
                                        } else {
                                            $relatedImgSrc = asset($related->gambar);
                                        }
                                    }
                                @endphp
                                <img src="{{ $relatedImgSrc }}" alt="{{ $related->judul }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm text-blue-600 font-medium">{{ ucfirst($related->kategori) }}</span>
                                        <span class="text-sm text-gray-500">{{ date('d M Y', strtotime($related->tanggal)) }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $related->judul }}</h3>
                                    <p class="text-gray-600 mb-4">{{ $related->ringkasan }}</p>
                                    <a href="{{ route('berita.show', $related->id) }}"
                                       class="text-green-600 hover:text-green-700 font-medium">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
