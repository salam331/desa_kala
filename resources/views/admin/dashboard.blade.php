@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="py-20 md:py-8 lg:py-12">
        <div class="w-full sm:max-w-7xl sm:mx-auto px-3 sm:px-4 md:px-6 lg:px-8 space-y-4 md:space-y-6">

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Pengaduan -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Total Pengaduan</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $stats['total_pengaduan'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Pending</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $stats['pengaduan_pending'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Diproses -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Diproses</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $stats['pengaduan_diproses'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Admin -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Total Admin</p>
                            <p class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $stats['total_admin'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Pengaduan & Activity Logs -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Recent Pengaduan -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Pengaduan Terbaru
                    </h3>

                    <div class="space-y-3">
                        @forelse($recent_pengaduan as $pengaduan)
                                        <div
                                            class="border-l-4 pl-4 py-2 rounded-md {{ $pengaduan->status == 'pending' ? 'border-yellow-500' : ($pengaduan->status == 'diproses' ? 'border-blue-500' : 'border-green-500') }}">
                                            <div class="flex justify-between gap-3">
                                                <div class="min-w-0">
                                                    <h4 class="font-medium text-gray-900 dark:text-gray-100 text-sm md:text-base">
                                                        {{ $pengaduan->judul }}
                                                    </h4>
                                                    <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $pengaduan->nama }} - {{ $pengaduan->kategori }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $pengaduan->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <span class="px-2 py-1 text-xs rounded-full whitespace-nowrap {{ 
                                                    $pengaduan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($pengaduan->status == 'diproses' ? 'bg-blue-100 text-blue-800' :
                                'bg-green-100 text-green-800') }}">
                                                    {{ ucfirst($pengaduan->status) }}
                                                </span>
                                            </div>
                                        </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada pengaduan.</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.pengaduan') }}"
                            class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua Pengaduan →</a>
                    </div>
                </div>

                <!-- Activity Logs -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Aktivitas Terbaru
                    </h3>

                    <ul class="space-y-3">
                        @forelse($logs as $log)
                            <li class="pb-3 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-9 h-9 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-semibold text-gray-800 dark:text-white">
                                            {{ substr($log->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $log->user->name }}
                                        </p>
                                        <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400">{{ $log->action }}</p>

                                        @if($log->details)
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $log->details }}
                                            </p>
                                        @endif

                                        <p class="text-xs text-gray-500 mt-1">{{ $log->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Tidak ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('admin.logs') }}" class="text-blue-600 text-sm font-medium hover:underline">
                            Lihat Semua Log →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg md:text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Aksi Cepat</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    <!-- Item -->
                    <a href="{{ route('admin.pengaduan') }}"
                        class="flex flex-col items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                        <svg class="w-7 h-7 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Kelola Pengaduan</span>
                    </a>

                    <!-- Item -->
                    <a href="{{ route('admin.manage-admins') }}"
                        class="flex flex-col items-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/40 transition">
                        <svg class="w-7 h-7 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Kelola Admin</span>
                    </a>

                    <!-- Item -->
                    <a href="{{ route('admin.logs') }}"
                        class="flex flex-col items-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/40 transition">
                        <svg class="w-7 h-7 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Log Aktivitas</span>
                    </a>

                    <!-- Item -->
                    <a href="{{ route('admin.welcome-elements.index') }}"
                        class="flex flex-col items-center p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/40 transition">
                        <svg class="w-7 h-7 text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium">Kelola Welcome</span>
                    </a>

                    <!-- Item -->
                    <a href="{{ route('admin.profile') }}"
                        class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-900/20 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900/40 transition">
                        <svg class="w-7 h-7 text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-sm font-medium">Profil Admin</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection