<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Berita')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $berita->judul)" required autofocus autocomplete="judul" />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" name="kategori" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Berita Desa" {{ old('kategori', $berita->kategori) == 'Berita Desa' ? 'selected' : '' }}>Berita Desa</option>
                                <option value="Kegiatan" {{ old('kategori', $berita->kategori) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Pengumuman" {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Informasi" {{ old('kategori', $berita->kategori) == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                                <option value="Berita Lainnya" {{ old('kategori', $berita->kategori) == 'Berita Lainnya' ? 'selected' : '' }}>Berita Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal', $berita->tanggal)" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <!-- Ringkasan -->
                        <div class="mb-4">
                            <x-input-label for="ringkasan" :value="__('Ringkasan')" />
                            <textarea id="ringkasan" name="ringkasan" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                            <x-input-error :messages="$errors->get('ringkasan')" class="mt-2" />
                        </div>

                        <!-- Konten -->
                        <div class="mb-4">
                            <x-input-label for="konten" :value="__('Konten Berita')" />
                            <textarea id="konten" name="konten" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('konten', $berita->konten) }}</textarea>
                            <x-input-error :messages="$errors->get('konten')" class="mt-2" />
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('URL Gambar (Opsional)')" />
                            <x-text-input id="gambar" class="block mt-1 w-full" type="url" name="gambar" :value="old('gambar', $berita->gambar)" autocomplete="gambar" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-4">
                            <x-input-label for="gambar_file" :value="__('Atau Upload Gambar Baru')" />
                            <input id="gambar_file" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="gambar_file" accept="image/*" />
                            <x-input-error :messages="$errors->get('gambar_file')" class="mt-2" />
                            @if($berita->gambar)
                                <p class="mt-2 text-sm text-gray-600">Gambar saat ini: <a href="{{ filter_var($berita->gambar, FILTER_VALIDATE_URL) ? $berita->gambar : asset($berita->gambar) }}" target="_blank" class="text-blue-600 hover:text-blue-800">Lihat gambar</a></p>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.berita.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button>
                                {{ __('Update Berita') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
