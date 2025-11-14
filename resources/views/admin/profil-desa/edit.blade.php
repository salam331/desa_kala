@extends('layouts.admin')

@section('title', 'Edit Profil Desa')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Profil Desa
            </h2>
        </div>

        <!-- Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <form action="{{ route('admin.profil-desa.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Sejarah Desa -->
                    <div class="mb-6">
                        <x-input-label for="sejarah_desa" :value="__('Sejarah Desa')" />
                        <textarea id="sejarah_desa" name="sejarah_desa" rows="4"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>{{ old('sejarah_desa', $profilDesa->sejarah_desa ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('sejarah_desa')" class="mt-2" />
                    </div>

                    <!-- Visi & Misi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="visi" :value="__('Visi')" />
                            <textarea id="visi" name="visi" rows="4"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('visi', $profilDesa->visi ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('visi')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="misi" :value="__('Misi')" />
                            <textarea id="misi" name="misi" rows="4"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('misi', $profilDesa->misi ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('misi')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Data Wilayah -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Data Wilayah</h3>
                    <div class="border-b mb-4"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="luas_wilayah" :value="__('Luas Wilayah')" />
                            <x-text-input id="luas_wilayah" type="text" name="luas_wilayah"
                                :value="old('luas_wilayah', $profilDesa->data_wilayah['luas_wilayah'] ?? '')"
                                class="w-full" required />
                            <x-input-error :messages="$errors->get('luas_wilayah')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jumlah_dusun" :value="__('Jumlah Dusun')" />
                            <x-text-input id="jumlah_dusun" type="number" name="jumlah_dusun"
                                :value="old('jumlah_dusun', $profilDesa->data_wilayah['jumlah_dusun'] ?? '')"
                                class="w-full" required />
                            <x-input-error :messages="$errors->get('jumlah_dusun')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jumlah_rt" :value="__('Jumlah RT')" />
                            <x-text-input id="jumlah_rt" type="number" name="jumlah_rt"
                                :value="old('jumlah_rt', $profilDesa->data_wilayah['jumlah_rt'] ?? '')"
                                class="w-full" required />
                            <x-input-error :messages="$errors->get('jumlah_rt')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jumlah_rw" :value="__('Jumlah RW')" />
                            <x-text-input id="jumlah_rw" type="number" name="jumlah_rw"
                                :value="old('jumlah_rw', $profilDesa->data_wilayah['jumlah_rw'] ?? '')"
                                class="w-full" required />
                            <x-input-error :messages="$errors->get('jumlah_rw')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Batas Wilayah -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="batas_utara" :value="__('Batas Utara')" />
                            <x-text-input id="batas_utara" type="text" name="batas_utara"
                                :value="old('batas_utara', $profilDesa->data_wilayah['batas_utara'] ?? '')"
                                class="w-full" required />
                        </div>

                        <div>
                            <x-input-label for="batas_selatan" :value="__('Batas Selatan')" />
                            <x-text-input id="batas_selatan" type="text" name="batas_selatan"
                                :value="old('batas_selatan', $profilDesa->data_wilayah['batas_selatan'] ?? '')"
                                class="w-full" required />
                        </div>

                        <div>
                            <x-input-label for="batas_timur" :value="__('Batas Timur')" />
                            <x-text-input id="batas_timur" type="text" name="batas_timur"
                                :value="old('batas_timur', $profilDesa->data_wilayah['batas_timur'] ?? '')"
                                class="w-full" required />
                        </div>

                        <div>
                            <x-input-label for="batas_barat" :value="__('Batas Barat')" />
                            <x-text-input id="batas_barat" type="text" name="batas_barat"
                                :value="old('batas_barat', $profilDesa->data_wilayah['batas_barat'] ?? '')"
                                class="w-full" required />
                        </div>
                    </div>

                    <!-- Peta & Koordinat -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Peta & Koordinat</h3>
                    <div class="border-b mb-4"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" type="number" step="any" name="latitude"
                                :value="old('latitude', $profilDesa->latitude ?? '')"
                                class="w-full" />
                        </div>

                        <div>
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" type="number" step="any" name="longitude"
                                :value="old('longitude', $profilDesa->longitude ?? '')"
                                class="w-full" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="peta_embed" :value="__('Embed / URL Peta')" />
                        <textarea id="peta_embed" name="peta_embed" rows="4"
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Masukkan iframe embed atau URL peta">{{ old('peta_embed', $profilDesa->peta_embed ?? '') }}</textarea>
                        <x-input-error :messages="$errors->get('peta_embed')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-center justify-end mt-6 space-y-2 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('admin.profil-desa.index') }}"
                            class="w-full sm:w-auto text-center px-4 py-2 text-gray-600 hover:text-gray-900 border border-gray-300 rounded-md">
                            Kembali
                        </a>

                        <x-primary-button class="w-full sm:w-auto">
                            Simpan Perubahan
                        </x-primary-button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
@endsection
