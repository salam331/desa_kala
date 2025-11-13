@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.galeri.update', $galeri->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Galeri</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $galeri->judul) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('judul') border-red-500 @enderror">
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi Galeri -->
                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gambar -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Gambar</label>

                                {{-- Gambar lama --}}
                                @if($galeri->children && $galeri->children->count())
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                        @foreach($galeri->children as $child)
                                            <div class="border rounded p-2">
                                                <img src="{{ asset($child->gambar) }}" alt="{{ $child->judul }}"
                                                    class="h-32 w-full object-cover rounded mb-2">

                                                <label class="block text-xs font-medium text-gray-700">Deskripsi Gambar</label>
                                                <textarea name="image_descriptions[{{ $child->id }}]" rows="2"
                                                    class="w-full border-gray-300 rounded-md">{{ old('image_descriptions.' . $child->id, $child->deskripsi) }}</textarea>

                                                <div class="mt-2 flex items-center">
                                                    <input type="checkbox" name="delete_images[]" value="{{ $child->id }}"
                                                        id="del_{{ $child->id }}" class="rounded">
                                                    <label for="del_{{ $child->id }}" class="ml-2 text-xs text-red-600">Hapus gambar
                                                        ini</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Gambar baru --}}
                                <div id="image-container">
                                    <div class="image-input mb-2">
                                        <input type="file" name="gambar[]" accept="image/*" multiple
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    </div>
                                </div>

                                <button type="button" id="add-image"
                                    class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    + Tambah Gambar Baru
                                </button>

                                <p class="mt-1 text-sm text-gray-500">
                                    Format: JPEG, PNG, JPG, GIF. Maksimal 2MB per gambar.
                                </p>
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="kategori" id="kategori"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="kegiatan" {{ old('kategori', $galeri->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan Desa</option>
                                    <option value="pembangunan" {{ old('kategori', $galeri->kategori) == 'pembangunan' ? 'selected' : '' }}>Pembangunan Infrastruktur</option>
                                    <option value="event" {{ old('kategori', $galeri->kategori) == 'event' ? 'selected' : '' }}>Event dan Festival</option>
                                    <option value="panorama" {{ old('kategori', $galeri->kategori) == 'panorama' ? 'selected' : '' }}>Panorama Desa</option>
                                </select>
                            </div>

                            <!-- Album -->
                            <div>
                                <label for="album" class="block text-sm font-medium text-gray-700">Album</label>
                                <input type="text" name="album" id="album" value="{{ old('album', $galeri->album) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal"
                                    value="{{ old('tanggal', $galeri->tanggal->format('Y-m-d')) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <!-- Status Aktif -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktifkan galeri ini
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end">
                            <a href="{{ route('admin.galeri.index') }}"
                                class="mr-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Batal
                            </a>

                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT TAMBAH GAMBAR + DESKRIPSI --}}
    <script>
        document.getElementById('add-image').addEventListener('click', function () {
            const container = document.getElementById('image-container');

            const wrapper = document.createElement('div');
            wrapper.className = "image-input mb-4 p-3 border rounded-md bg-gray-50";

            wrapper.innerHTML = `
                    <label class="block text-sm font-medium text-gray-700">Gambar Baru</label>
                    <input type="file" name="gambar[]" accept="image/*"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                    <label class="block text-sm font-medium text-gray-700 mt-3">Deskripsi Gambar Baru</label>
                    <textarea name="deskripsi_gambar[]" rows="2"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Tulis deskripsi untuk gambar ini..."></textarea>

                    <button type="button"
                        class="mt-3 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm remove-image">
                        Hapus
                    </button>
                `;

            container.appendChild(wrapper);
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-image')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection