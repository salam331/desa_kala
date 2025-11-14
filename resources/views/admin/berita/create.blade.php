@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Berita Baru') }}
            </h2>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-4">
                            <x-input-label for="judul" :value="__('Judul Berita')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus autocomplete="judul" />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <select id="kategori" name="kategori" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Berita Desa" {{ old('kategori') == 'Berita Desa' ? 'selected' : '' }}>Berita Desa</option>
                                <option value="Kegiatan" {{ old('kategori') == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="Pengumuman" {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Informasi" {{ old('kategori') == 'Informasi' ? 'selected' : '' }}>Informasi</option>
                                <option value="Berita Lainnya" {{ old('kategori') == 'Berita Lainnya' ? 'selected' : '' }}>Berita Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal')" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <!-- Ringkasan -->
                        <div class="mb-4">
                            <x-input-label for="ringkasan" :value="__('Ringkasan')" />
                            <textarea id="ringkasan" name="ringkasan" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('ringkasan') }}</textarea>
                            <x-input-error :messages="$errors->get('ringkasan')" class="mt-2" />
                        </div>

                        <!-- Konten -->
                        <div class="mb-4">
                            <x-input-label for="konten" :value="__('Konten Berita')" />
                            <textarea id="konten" name="konten" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('konten') }}</textarea>
                            <x-input-error :messages="$errors->get('konten')" class="mt-2" />
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('URL Gambar (Opsional)')" />
                            <x-text-input id="gambar" class="block mt-1 w-full" type="url" name="gambar" :value="old('gambar')" autocomplete="gambar" />
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-4">
                            <x-input-label for="gambar_file" :value="__('Atau Upload Gambar')" />
                            <input id="gambar_file" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="gambar_file" accept="image/*" />
                            <x-input-error :messages="$errors->get('gambar_file')" class="mt-2" />
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-end mt-6 space-y-2 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('admin.berita.index') }}" class="w-full sm:w-auto text-center px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-md">Batal</a>
                            <x-primary-button class="w-full sm:w-auto">
                                {{ __('Simpan Berita') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
