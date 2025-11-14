@extends('layouts.admin')

@section('title', 'Kelola Pengaduan Masyarakat')

@section('content')
    <div class="py-20 md:py-8 lg:py-12">
        <div class="w-full sm:max-w-7xl sm:mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-xl text-neutral-900 leading-tight">
                    {{ __('Kelola Pengaduan Masyarakat') }}
                </h2>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Filter Tabs -->
                    <div class="mb-6">
                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <nav class="-mb-px flex flex-wrap gap-2 sm:gap-4 md:gap-8">
                                <a href="?status=all"
                                    class="py-2 px-1 border-b-2 font-medium text-xs sm:text-sm {{ request('status', 'all') == 'all' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    Semua ({{ $totalPengaduan }})
                                </a>
                                <a href="?status=pending"
                                    class="py-2 px-1 border-b-2 font-medium text-xs sm:text-sm {{ request('status') == 'pending' ? 'border-yellow-500 text-yellow-600 dark:text-yellow-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    Pending ({{ $pendingCount }})
                                </a>
                                <a href="?status=diproses"
                                    class="py-2 px-1 border-b-2 font-medium text-xs sm:text-sm {{ request('status') == 'diproses' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    Diproses ({{ $diprosesCount }})
                                </a>
                                <a href="?status=selesai"
                                    class="py-2 px-1 border-b-2 font-medium text-xs sm:text-sm {{ request('status') == 'selesai' ? 'border-green-500 text-green-600 dark:text-green-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    Selesai ({{ $selesaiCount }})
                                </a>
                            </nav>
                        </div>
                    </div>

                    <!-- Pengaduan List -->
                    <!-- Pengaduan List -->
                    <div class="space-y-4">
                        @forelse($pengaduan as $item)
                                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 md:p-6
                                {{ $item->status == 'pending' ? 'bg-yellow-50 dark:bg-yellow-900/10' :
                            ($item->status == 'diproses' ? 'bg-blue-50 dark:bg-blue-900/10' :
                                'bg-green-50 dark:bg-green-900/10') }}">

                                            <!-- Header (Judul + Status + Kategori) -->
                                            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-4 gap-3">

                                                <div class="flex-1">
                                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                            {{ $item->judul }}
                                                        </h3>

                                                        <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                            ($item->status == 'diproses' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                                                            {{ ucfirst($item->status) }}
                                                        </span>

                                                        <span
                                                            class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                            {{ ucfirst($item->kategori) }}
                                                        </span>
                                                    </div>

                                                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                                        <strong>{{ $item->nama }}</strong> — {{ $item->email }} — {{ $item->telepon }}
                                                    </div>

                                                    <p class="text-gray-700 dark:text-gray-300 mb-3">
                                                        {{ $item->deskripsi }}
                                                    </p>

                                                    <div class="text-xs text-gray-500 dark:text-gray-500">
                                                        Dikirim:
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}

                                                        @if($item->tanggal_tanggapan)
                                                            | Ditanggapi:
                                                            {{ \Carbon\Carbon::parse($item->tanggal_tanggapan)->format('d/m/Y H:i') }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tanggapan Admin -->
                                            @if($item->tanggapan)
                                                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                                    <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Tanggapan Admin:</h4>
                                                    <p class="text-gray-700 dark:text-gray-300">{{ $item->tanggapan }}</p>
                                                </div>
                                            @endif

                                            <!-- Update Form (Fully Responsive) -->
                                            <form method="POST" action="{{ route('admin.pengaduan.update-status', $item->id) }}"
                                                class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                                @csrf

                                                <!-- Status -->
                                                <div>
                                                    <select name="status" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                                                   shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                                                   dark:bg-gray-700 dark:text-gray-100">
                                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses
                                                        </option>
                                                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Tanggapan -->
                                                <div>
                                                    <textarea name="tanggapan" rows="2" placeholder="Tanggapan (opsional)" class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md 
                                                   shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                                                   dark:bg-gray-700 dark:text-gray-100">{{ old('tanggapan', $item->tanggapan) }}</textarea>
                                                </div>

                                                <!-- Tombol Submit -->
                                                <div class="flex items-start md:items-center">
                                                    <button type="submit"
                                                        class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        Update
                                                    </button>
                                                </div>

                                            </form>

                                        </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Tidak ada pengaduan</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada pengaduan yang masuk.</p>
                            </div>
                        @endforelse
                    </div>


                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pengaduan->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection