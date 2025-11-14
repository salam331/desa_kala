@extends('layouts.admin')

@section('title', 'Edit Struktur Pemerintahan')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Anggota Struktur Pemerintahan') }}
                </h2>
            </div>

            <!-- Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('admin.struktur-pemerintahan.update', $struktur->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <x-input-label for="nama" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $struktur->nama)" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-4">
                            <x-input-label for="jabatan" :value="__('Jabatan')" />
                            <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan"
                                :value="old('jabatan', $struktur->jabatan)" required />
                            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                        </div>

                        <!-- Urutan -->
                        <div class="mb-4">
                            <x-input-label for="urutan" :value="__('Urutan Tampilan')" />
                            <x-text-input id="urutan" class="block mt-1 w-full" type="number" name="urutan"
                                :value="old('urutan', $struktur->urutan)" min="0" required />
                            <small class="text-gray-500 text-sm">Urutan tampilan (0 = teratas)</small>
                            <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="is_active" :value="__('Status')" />
                            <select id="is_active" name="is_active"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1" {{ old('is_active', $struktur->is_active) == 1 ? 'selected' : '' }}>Aktif
                                </option>
                                <option value="0" {{ old('is_active', $struktur->is_active) == 0 ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <!-- Foto -->
                        <div class="mb-4">
                            <x-input-label for="foto" :value="__('Foto (Opsional)')" />
                            @if($struktur->foto)
                                <div class="mb-2">
                                    <img src="{{ asset($struktur->foto) }}" alt="{{ $struktur->nama }}"
                                        class="rounded shadow-sm w-32">
                                    <p class="text-gray-500 text-sm mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <input id="foto" type="file" name="foto" accept="image/*"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
                            <small class="text-gray-500 text-sm">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak
                                ingin mengubah foto.</small>
                            <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        </div>

                        <!-- Tombol aksi -->
                        <div
                            class="flex flex-col sm:flex-row items-center justify-end mt-6 space-y-2 sm:space-y-0 sm:space-x-4">
                            <a href="{{ route('admin.struktur-pemerintahan.index') }}"
                                class="w-full sm:w-auto text-center px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-md">
                                Batal
                            </a>
                            <x-primary-button class="w-full sm:w-auto">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection