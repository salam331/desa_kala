@extends('layouts.admin')

@section('title', 'Profil Desa')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Profil Desa
                </h2>
                <a href="{{ route('admin.profil-desa.edit') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                    <i class="fas fa-edit mr-2"></i>Edit Profil Desa
                </a>
            </div>

            <!-- Card Utama -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                <div class="p-6 bg-white border-b border-gray-200">

                    @if($profilDesa)

                        <!-- Sejarah Desa -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Sejarah Desa</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $profilDesa->sejarah_desa }}</p>
                            <hr class="my-4">
                        </div>

                        <!-- Visi & Misi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Visi</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $profilDesa->visi }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Misi</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $profilDesa->misi }}</p>
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Data Wilayah -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Data Wilayah</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p><strong>Luas Wilayah:</strong> {{ $profilDesa->data_wilayah['luas_wilayah'] ?? '-' }}</p>
                                    <p><strong>Jumlah Dusun:</strong> {{ $profilDesa->data_wilayah['jumlah_dusun'] ?? '-' }}</p>
                                    <p><strong>Jumlah RT:</strong> {{ $profilDesa->data_wilayah['jumlah_rt'] ?? '-' }}</p>
                                    <p><strong>Jumlah RW:</strong> {{ $profilDesa->data_wilayah['jumlah_rw'] ?? '-' }}</p>
                                </div>

                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p><strong>Batas Utara:</strong> {{ $profilDesa->data_wilayah['batas_utara'] ?? '-' }}</p>
                                    <p><strong>Batas Selatan:</strong> {{ $profilDesa->data_wilayah['batas_selatan'] ?? '-' }}
                                    </p>
                                    <p><strong>Batas Timur:</strong> {{ $profilDesa->data_wilayah['batas_timur'] ?? '-' }}</p>
                                    <p><strong>Batas Barat:</strong> {{ $profilDesa->data_wilayah['batas_barat'] ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="my-6">

                        <!-- Peta -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Peta dan Koordinat</h3>

                            @if($profilDesa->peta_embed_display)
                                <div class="rounded-lg overflow-hidden shadow">
                                    {!! $profilDesa->peta_embed_display !!}
                                </div>
                            @else
                                <p class="text-gray-500">Tidak ada peta yang disematkan.</p>
                            @endif

                            @if($profilDesa->latitude && $profilDesa->longitude)
                                <p class="mt-3 text-gray-700">
                                    <strong>Koordinat:</strong> {{ $profilDesa->latitude }}, {{ $profilDesa->longitude }}
                                </p>
                            @endif
                        </div>

                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded mb-4">
                            <h4 class="font-bold mb-1">Belum ada data profil desa!</h4>
                            Silakan <a href="{{ route('admin.profil-desa.edit') }}" class="underline">buat profil desa</a>
                            terlebih dahulu.
                        </div>
                    @endif

                </div>
            </div>

            <!-- Riwayat Perubahan -->
            <div class="mt-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Perubahan Profil Desa</h2>

                <div class="bg-white shadow sm:rounded-lg overflow-hidden">

                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Detail</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($logs as $log)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{ $log->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $log->user->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $log->details }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.profil-desa.edit') }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada riwayat perubahan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="block md:hidden p-4 space-y-4">
                        @forelse($logs as $log)
                            <div class="bg-gray-50 border rounded-lg p-4">
                                <p class="text-sm"><strong>Tanggal:</strong> {{ $log->created_at->format('d/m/Y H:i') }}</p>
                                <p class="text-sm"><strong>Admin:</strong> {{ $log->user->name ?? 'Unknown' }}</p>
                                <p class="text-sm mb-3"><strong>Detail:</strong> {{ $log->details }}</p>
                                <a href="{{ route('admin.profil-desa.edit') }}"
                                    class="block text-center bg-indigo-600 text-white py-2 px-3 rounded text-sm hover:bg-indigo-700">
                                    Edit
                                </a>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-6">
                                Belum ada riwayat perubahan.
                            </div>
                        @endforelse
                    </div>

                    <div class="p-4">
                        {{ $logs->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection