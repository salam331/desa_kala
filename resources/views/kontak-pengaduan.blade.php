<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak & Pengaduan - Desa Kala</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-20">

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-700">Kontak & Pengaduan Desa Kala</h1>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Formulir Pengaduan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-800">Formulir Pengaduan Masyarakat</h2>

                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon *</label>
                        <input type="tel" id="telepon" name="telepon" value="{{ old('telepon') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               required>
                    </div>

                    <div class="mb-4">
                        <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori Pengaduan *</label>
                        <select id="kategori" name="kategori"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="pelayanan" {{ old('kategori') == 'pelayanan' ? 'selected' : '' }}>Pelayanan Publik</option>
                            <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                            <option value="lingkungan" {{ old('kategori') == 'lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                            <option value="kesehatan" {{ old('kategori') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="pendidikan" {{ old('kategori') == 'pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Pengaduan *</label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                               placeholder="Ringkasan singkat pengaduan Anda"
                               required>
                    </div>

                    <div class="mb-6">
                        <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Pengaduan *</label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                  placeholder="Jelaskan secara detail pengaduan Anda, termasuk lokasi, waktu kejadian, dan bukti-bukti yang ada"
                                  required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Kirim Pengaduan
                    </button>
                </form>

                <div class="mt-6 text-sm text-gray-600">
                    <p><strong>Catatan:</strong></p>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        <li>Pengaduan akan diproses dalam 3-5 hari kerja</li>
                        <li>Anda akan menerima notifikasi melalui email</li>
                        <li>Pastikan data yang dimasukkan benar dan lengkap</li>
                        <li>Lampirkan bukti pendukung jika memungkinkan</li>
                    </ul>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="space-y-6">
                <!-- Kontak Pemerintah Desa -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Kontak Pemerintah Desa</h2>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="bg-green-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Alamat</h3>
                                <p class="text-gray-600">Jl. Raya Desa Kala No. 123<br>
                                Desa Kala, Kecamatan Kala<br>
                                Kabupaten Kala, Provinsi Jawa Barat<br>
                                Kode Pos: 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Telepon</h3>
                                <p class="text-gray-600">(021) 123-4567</p>
                                <p class="text-sm text-gray-500">Senin - Jumat, 08.00 - 15.00 WIB</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">Email</h3>
                                <p class="text-gray-600">info@desakala.go.id</p>
                                <p class="text-gray-600">kepaladesa@desakala.go.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peta Lokasi -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Lokasi Desa Kala</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d107.0!3d-6.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMDAnMDAuMCJTIDEwN8KwMDAnMDAuMCJF!5e0!3m2!1sen!2sid!4v1630000000000!5m2!1sen!2sid"
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        Klik pada peta untuk melihat lokasi yang lebih detail atau gunakan aplikasi navigasi untuk mencapai lokasi kami.
                    </p>
                </div>

                <!-- Jam Operasional -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Jam Operasional</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-700">Senin - Kamis</span>
                            <span class="text-gray-600">08.00 - 15.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Jumat</span>
                            <span class="text-gray-600">08.00 - 11.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Sabtu</span>
                            <span class="text-gray-600">08.00 - 12.00 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-700">Minggu & Hari Libur</span>
                            <span class="text-gray-600">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
