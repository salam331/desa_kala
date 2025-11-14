<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $parent->judul }} - Galeri Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 py-20">

    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $parent->judul }}</h1>
        @if($parent->deskripsi)
            <p class="mb-6 text-gray-700">{{ $parent->deskripsi }}</p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($images as $img)
                <div class="overflow-hidden rounded shadow">
                    <img src="{{ $img['url'] }}" alt="{{ $img['judul'] }}" class="w-full h-48 object-cover">
                    <div class="p-3">
                        @if($img['deskripsi'])
                            <p class="text-sm text-gray-700">{{ $img['deskripsi'] }}</p>
                        @endif
                        @if($img['deskfoto'])
                            <p class="text-sm text-gray-600 mt-1">{{ $img['deskfoto'] }}</p>
                        @endif
                        <p class="text-xs text-gray-500 mt-2">{{ $img['tanggal'] }}</p>
                    </div>
                </div>
            @empty
                <p>Tidak ada gambar untuk galeri ini.</p>
            @endforelse
        </div>

    </div>

    <script>
        // optional: you can add lightbox behavior here
    </script>
</body>
</html>
