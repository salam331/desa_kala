@extends('layouts.admin')

@section('title', 'Profil Desa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Profil Desa</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.profil-desa.edit') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit Profil Desa
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($profilDesa)
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Sejarah Desa</h4>
                                <p>{{ $profilDesa->sejarah_desa }}</p>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>Visi</h4>
                                <p>{{ $profilDesa->visi }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Misi</h4>
                                <p>{{ $profilDesa->misi }}</p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Data Wilayah</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Luas Wilayah:</strong> {{ $profilDesa->data_wilayah['luas_wilayah'] ?? '-' }}<br>
                                        <strong>Jumlah Dusun:</strong> {{ $profilDesa->data_wilayah['jumlah_dusun'] ?? '-' }}<br>
                                        <strong>Jumlah RT:</strong> {{ $profilDesa->data_wilayah['jumlah_rt'] ?? '-' }}<br>
                                        <strong>Jumlah RW:</strong> {{ $profilDesa->data_wilayah['jumlah_rw'] ?? '-' }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Batas Utara:</strong> {{ $profilDesa->data_wilayah['batas_utara'] ?? '-' }}<br>
                                        <strong>Batas Selatan:</strong> {{ $profilDesa->data_wilayah['batas_selatan'] ?? '-' }}<br>
                                        <strong>Batas Timur:</strong> {{ $profilDesa->data_wilayah['batas_timur'] ?? '-' }}<br>
                                        <strong>Batas Barat:</strong> {{ $profilDesa->data_wilayah['batas_barat'] ?? '-' }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Peta dan Koordinat</h4>
                                @if($profilDesa->peta_embed_display)
                                    <div class="embed-responsive embed-responsive-16by9">
                                        {!! $profilDesa->peta_embed_display !!}
                                    </div>
                                @else
                                    <p>Tidak ada peta yang disematkan.</p>
                                @endif
                                @if($profilDesa->latitude && $profilDesa->longitude)
                                    <p><strong>Koordinat:</strong> {{ $profilDesa->latitude }}, {{ $profilDesa->longitude }}</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <h4><i class="icon fas fa-warning"></i> Belum ada data profil desa!</h4>
                            Silakan <a href="{{ route('admin.profil-desa.edit') }}">buat profil desa</a> terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Perubahan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Perubahan Profil Desa</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Admin</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $log->user->name ?? 'Unknown' }}</td>
                                    <td>{{ $log->details }}</td>
                                    <td>
                                        <a href="{{ route('admin.profil-desa.edit') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada riwayat perubahan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
