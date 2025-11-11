@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Layanan Publik</h1>
            <a href="{{ route('admin.layanan.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Layanan -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan *</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
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
                            <option value="administrasi" {{ old('kategori') === 'administrasi' ? 'selected' : '' }}>Administrasi</option>
                            <option value="perizinan" {{ old('kategori') === 'perizinan' ? 'selected' : '' }}>Perizinan</option>
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Proses -->
                    <div>
                        <label for="waktu_proses" class="block text-sm font-medium text-gray-700 mb-2">Waktu Proses *</label>
                        <input type="text" id="waktu_proses" name="waktu_proses" value="{{ old('waktu_proses') }}"
                               placeholder="contoh: 3 hari kerja"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('waktu_proses') border-red-500 @enderror"
                               required>
                        @error('waktu_proses')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Biaya -->
                    <div>
                        <label for="biaya" class="block text-sm font-medium text-gray-700 mb-2">Biaya *</label>
                        <input type="text" id="biaya" name="biaya" value="{{ old('biaya') }}"
                               placeholder="contoh: Rp 5.000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('biaya') border-red-500 @enderror"
                               required>
                        @error('biaya')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak *</label>
                        <input type="text" id="kontak" name="kontak" value="{{ old('kontak') }}"
                               placeholder="contoh: Kantor Desa Kala - Bagian Administrasi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kontak') border-red-500 @enderror"
                               required>
                        @error('kontak')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gambar') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
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
                              required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prosedur -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prosedur *</label>
                    <div id="prosedur-container">
                        @if(old('prosedur'))
                            @foreach(old('prosedur') as $index => $prosedur)
                                <div class="flex items-center mb-2 prosedur-item">
                                    <input type="text" name="prosedur[]" value="{{ $prosedur }}"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Langkah {{ $index + 1 }}">
                                    <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-prosedur">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center mb-2 prosedur-item">
                                <input type="text" name="prosedur[]" value=""
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Langkah 1">
                                <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-prosedur">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-prosedur" class="mt-2 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-plus mr-1"></i>Tambah Langkah
                    </button>
                    @error('prosedur')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('prosedur.*')
                        <p class="mt-1 text-sm text-red-600">Semua langkah prosedur harus diisi.</p>
                    @enderror
                </div>

                <!-- Syarat -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Syarat *</label>
                    <div id="syarat-container">
                        @if(old('syarat'))
                            @foreach(old('syarat') as $index => $syarat)
                                <div class="flex items-center mb-2 syarat-item">
                                    <input type="text" name="syarat[]" value="{{ $syarat }}"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Syarat {{ $index + 1 }}">
                                    <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-syarat">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center mb-2 syarat-item">
                                <input type="text" name="syarat[]" value=""
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Syarat 1">
                                <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-syarat">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" id="add-syarat" class="mt-2 text-blue-600 hover:text-blue-800">
                        <i class="fas fa-plus mr-1"></i>Tambah Syarat
                    </button>
                    @error('syarat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('syarat.*')
                        <p class="mt-1 text-sm text-red-600">Semua syarat harus diisi.</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.layanan.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add Prosedur
    document.getElementById('add-prosedur').addEventListener('click', function() {
        const container = document.getElementById('prosedur-container');
        const items = container.querySelectorAll('.prosedur-item');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center mb-2 prosedur-item';
        newItem.innerHTML = `
            <input type="text" name="prosedur[]" value=""
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Langkah ${items.length + 1}">
            <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-prosedur">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(newItem);
    });

    // Add Syarat
    document.getElementById('add-syarat').addEventListener('click', function() {
        const container = document.getElementById('syarat-container');
        const items = container.querySelectorAll('.syarat-item');
        const newItem = document.createElement('div');
        newItem.className = 'flex items-center mb-2 syarat-item';
        newItem.innerHTML = `
            <input type="text" name="syarat[]" value=""
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Syarat ${items.length + 1}">
            <button type="button" class="ml-2 text-red-600 hover:text-red-800 remove-syarat">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(newItem);
    });

    // Remove Prosedur
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-prosedur') || e.target.closest('.remove-prosedur')) {
            const container = document.getElementById('prosedur-container');
            const items = container.querySelectorAll('.prosedur-item');
            if (items.length > 1) {
                e.target.closest('.prosedur-item').remove();
            }
        }
    });

    // Remove Syarat
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-syarat') || e.target.closest('.remove-syarat')) {
            const container = document.getElementById('syarat-container');
            const items = container.querySelectorAll('.syarat-item');
            if (items.length > 1) {
                e.target.closest('.syarat-item').remove();
            }
        }
    });
});
</script>
@endsection
