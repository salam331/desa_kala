@extends('layouts.admin')

@section('title', 'Log Aktivitas Admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Desktop Header -->
        <div class="hidden md:flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Log Aktivitas Admin') }}
            </h2>
            <div class="flex items-center space-x-2">
                <button onclick="window.location.reload()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
        </div>

        <!-- Mobile Header -->
        <div class="block md:hidden mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Log Aktivitas Admin') }}
            </h2>
            <button onclick="window.location.reload()" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg shadow-md hover:bg-blue-700 transition flex items-center justify-center">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Admin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Detail</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            <div class="h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600 dark:text-gray-300 text-xs"></i>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $log->user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if(str_contains($log->action, 'create') || str_contains($log->action, 'store'))
                                            bg-green-100 text-green-800
                                        @elseif(str_contains($log->action, 'update') || str_contains($log->action, 'edit'))
                                            bg-blue-100 text-blue-800
                                        @elseif(str_contains($log->action, 'delete') || str_contains($log->action, 'destroy'))
                                            bg-red-100 text-red-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        <i class="fas fa-{{ str_contains($log->action, 'create') || str_contains($log->action, 'store') ? 'plus' : (str_contains($log->action, 'update') || str_contains($log->action, 'edit') ? 'edit' : (str_contains($log->action, 'delete') || str_contains($log->action, 'destroy') ? 'trash' : 'info')) }} mr-1"></i>
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300 max-w-xs truncate" title="{{ $log->details }}">
                                    {{ Str::limit($log->details, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    <div class="flex flex-col">
                                        <span>{{ $log->created_at->format('d/m/Y') }}</span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">{{ $log->created_at->format('H:i:s') }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center py-8">
                                        <i class="fas fa-history text-gray-400 text-4xl mb-4"></i>
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">Belum ada aktivitas</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Log aktivitas admin akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>

        <!-- Mobile Card View -->
        <div class="block md:hidden space-y-4">
            @forelse($logs as $log)
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600 dark:text-gray-300"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $log->user->name }}</h3>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if(str_contains($log->action, 'create') || str_contains($log->action, 'store'))
                                            bg-green-100 text-green-800
                                        @elseif(str_contains($log->action, 'update') || str_contains($log->action, 'edit'))
                                            bg-blue-100 text-blue-800
                                        @elseif(str_contains($log->action, 'delete') || str_contains($log->action, 'destroy'))
                                            bg-red-100 text-red-800
                                        @else
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        <i class="fas fa-{{ str_contains($log->action, 'create') || str_contains($log->action, 'store') ? 'plus' : (str_contains($log->action, 'update') || str_contains($log->action, 'edit') ? 'edit' : (str_contains($log->action, 'delete') || str_contains($log->action, 'destroy') ? 'trash' : 'info')) }} mr-1"></i>
                                        {{ $log->action }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">{{ $log->details }}</p>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <i class="fas fa-clock mr-1"></i>
                                <span>{{ $log->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fas fa-history text-gray-400 text-6xl mb-4"></i>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada aktivitas</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Log aktivitas admin akan muncul di sini ketika ada aktivitas yang tercatat.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
