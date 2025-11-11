@extends('layouts.admin')

@section('title', 'Edit Konten Welcome')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Konten Welcome') }}
            </h2>
        </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.update-welcome') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Village Name -->
                        <div class="mb-4">
                            <x-input-label for="village_name" :value="__('Nama Desa')" />
                            <x-text-input id="village_name" name="village_name" type="text"
                                class="mt-1 block w-full" :value="old('village_name', $welcomeContent->village_name ?? '')" required />
                            <x-input-error :messages="$errors->get('village_name')" class="mt-2" />
                        </div>

                        <!-- Hero Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Hero Section</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="hero_title" :value="__('Judul Hero')" />
                                    <x-text-input id="hero_title" name="hero_title" type="text"
                                        class="mt-1 block w-full" :value="old('hero_title', $welcomeContent->hero_title ?? '')" required />
                                    <x-input-error :messages="$errors->get('hero_title')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="hero_button_text" :value="__('Teks Tombol')" />
                                    <x-text-input id="hero_button_text" name="hero_button_text" type="text"
                                        class="mt-1 block w-full" :value="old('hero_button_text', $welcomeContent->hero_button_text ?? '')" required />
                                    <x-input-error :messages="$errors->get('hero_button_text')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="hero_description" :value="__('Deskripsi Hero')" />
                                <textarea id="hero_description" name="hero_description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="3" required>{{ old('hero_description', $welcomeContent->hero_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('hero_description')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="hero_button_link" :value="__('Link Tombol')" />
                                <x-text-input id="hero_button_link" name="hero_button_link" type="text"
                                    class="mt-1 block w-full" :value="old('hero_button_link', $welcomeContent->hero_button_link ?? '')" required />
                                <x-input-error :messages="$errors->get('hero_button_link')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="hero_background_image" :value="__('URL Gambar Background Hero')" />
                                <x-text-input id="hero_background_image" name="hero_background_image" type="url"
                                    class="mt-1 block w-full" :value="old('hero_background_image', $welcomeContent->hero_background_image ?? '')" />
                                <x-input-error :messages="$errors->get('hero_background_image')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Profile Section -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Section Profil</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="profile_title" :value="__('Judul Profil')" />
                                    <x-text-input id="profile_title" name="profile_title" type="text"
                                        class="mt-1 block w-full" :value="old('profile_title', $welcomeContent->profile_title ?? '')" required />
                                    <x-input-error :messages="$errors->get('profile_title')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="profile_description" :value="__('Deskripsi Profil')" />
                                <textarea id="profile_description" name="profile_description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="2" required>{{ old('profile_description', $welcomeContent->profile_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('profile_description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Location Card -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Kartu Letak Geografis</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="location_title" :value="__('Judul')" />
                                    <x-text-input id="location_title" name="location_title" type="text"
                                        class="mt-1 block w-full" :value="old('location_title', $welcomeContent->location_title ?? '')" required />
                                    <x-input-error :messages="$errors->get('location_title')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="location_description" :value="__('Deskripsi')" />
                                <textarea id="location_description" name="location_description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="3" required>{{ old('location_description', $welcomeContent->location_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('location_description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Agriculture Card -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Kartu Potensi Pertanian</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="agriculture_title" :value="__('Judul')" />
                                    <x-text-input id="agriculture_title" name="agriculture_title" type="text"
                                        class="mt-1 block w-full" :value="old('agriculture_title', $welcomeContent->agriculture_title ?? '')" required />
                                    <x-input-error :messages="$errors->get('agriculture_title')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="agriculture_description" :value="__('Deskripsi')" />
                                <textarea id="agriculture_description" name="agriculture_description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="3" required>{{ old('agriculture_description', $welcomeContent->agriculture_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('agriculture_description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Culture Card -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Kartu Budaya & Tradisi</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="culture_title" :value="__('Judul')" />
                                    <x-text-input id="culture_title" name="culture_title" type="text"
                                        class="mt-1 block w-full" :value="old('culture_title', $welcomeContent->culture_title ?? '')" required />
                                    <x-input-error :messages="$errors->get('culture_title')" class="mt-2" />
                                </div>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="culture_description" :value="__('Deskripsi')" />
                                <textarea id="culture_description" name="culture_description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    rows="3" required>{{ old('culture_description', $welcomeContent->culture_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('culture_description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Footer</h3>

                            <div>
                                <x-input-label for="footer_text" :value="__('Teks Footer')" />
                                <x-text-input id="footer_text" name="footer_text" type="text"
                                    class="mt-1 block w-full" :value="old('footer_text', $welcomeContent->footer_text ?? '')" required />
                                <x-input-error :messages="$errors->get('footer_text')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
