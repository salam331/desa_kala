@extends('layouts.admin')

@section('title', 'Edit Potensi')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Potensi Desa') }}
            </h2>
            <a href="{{ route('admin.potensi.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Mobile Header -->
        <div class="block md:hidden mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Edit Potensi Desa') }}
            </h2>
            <a href="{{ route('admin.potensi.index') }}"
                class="w-full bg-gray-600 text-white px-4 py-3 rounded-lg shadow-md hover:bg-gray-700 transition flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.potensi.update', $potensi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Potensi -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Potensi *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $potensi->nama) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                               required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select id="kategori" name="kategori"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kategori') border-red-500 @enderror"
                                required>
                            <option value="">Pilih Kategori</option>
                            <option value="Pertanian" {{ old('kategori', $potensi->kategori) == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                            <option value="Wisata" {{ old('kategori', $potensi->kategori) == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                            <option value="UMKM" {{ old('kategori', $potensi->kategori) == 'UMKM' ? 'selected' : '' }}>UMKM</option>
                            <option value="Budaya" {{ old('kategori', $potensi->kategori) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="Pendidikan" {{ old('kategori', $potensi->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                            <option value="Kesehatan" {{ old('kategori', $potensi->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                            <option value="Infrastruktur" {{ old('kategori', $potensi->kategori) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="Lainnya" {{ old('kategori', $potensi->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                        <input type="text" id="kontak" name="kontak" value="{{ old('kontak', $potensi->kontak) }}"
                               placeholder="contoh: Bapak Ahmad - Ketua Kelompok Tani"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kontak') border-red-500 @enderror">
                        @error('kontak')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $potensi->telepon) }}"
                               placeholder="contoh: 081234567890"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('telepon') border-red-500 @enderror">
                        @error('telepon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $potensi->lokasi) }}"
                               placeholder="contoh: Dusun Kala Timur"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('lokasi') border-red-500 @enderror">
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        @if($potensi->gambar)
                            <div class="mb-2">
                                <img src="{{ asset($potensi->gambar) }}" alt="Current Image" class="w-20 h-20 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gambar') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $potensi->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Aktif (tampilkan di halaman publik)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror"
                              required>{{ old('deskripsi', $potensi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detail -->
                <div class="mt-6">
                    <label for="detail" class="block text-sm font-medium text-gray-700 mb-2">Detail Tambahan</label>
                    <textarea id="detail" name="detail" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('detail') border-red-500 @enderror"
                              placeholder="Informasi tambahan tentang potensi ini (opsional)">{{ old('detail', $potensi->detail) }}</textarea>
                    @error('detail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.potensi.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
