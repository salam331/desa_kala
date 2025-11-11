@extends('layouts.admin')

@section('title', 'Edit Profil Desa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profil Desa</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profil-desa.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sejarah_desa">Sejarah Desa</label>
                                    <textarea name="sejarah_desa" id="sejarah_desa" class="form-control @error('sejarah_desa') is-invalid @enderror" rows="6" required>{{ old('sejarah_desa', $profilDesa->sejarah_desa ?? '') }}</textarea>
                                    @error('sejarah_desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visi">Visi</label>
                                    <textarea name="visi" id="visi" class="form-control @error('visi') is-invalid @enderror" rows="4" required>{{ old('visi', $profilDesa->visi ?? '') }}</textarea>
                                    @error('visi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="misi">Misi</label>
                                    <textarea name="misi" id="misi" class="form-control @error('misi') is-invalid @enderror" rows="4" required>{{ old('misi', $profilDesa->misi ?? '') }}</textarea>
                                    @error('misi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Data Wilayah</h4>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="luas_wilayah">Luas Wilayah</label>
                                    <input type="text" name="luas_wilayah" id="luas_wilayah" class="form-control @error('luas_wilayah') is-invalid @enderror" value="{{ old('luas_wilayah', $profilDesa->data_wilayah['luas_wilayah'] ?? '') }}" required>
                                    @error('luas_wilayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_dusun">Jumlah Dusun</label>
                                    <input type="number" name="jumlah_dusun" id="jumlah_dusun" class="form-control @error('jumlah_dusun') is-invalid @enderror" value="{{ old('jumlah_dusun', $profilDesa->data_wilayah['jumlah_dusun'] ?? '') }}" required>
                                    @error('jumlah_dusun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_rt">Jumlah RT</label>
                                    <input type="number" name="jumlah_rt" id="jumlah_rt" class="form-control @error('jumlah_rt') is-invalid @enderror" value="{{ old('jumlah_rt', $profilDesa->data_wilayah['jumlah_rt'] ?? '') }}" required>
                                    @error('jumlah_rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_rw">Jumlah RW</label>
                                    <input type="number" name="jumlah_rw" id="jumlah_rw" class="form-control @error('jumlah_rw') is-invalid @enderror" value="{{ old('jumlah_rw', $profilDesa->data_wilayah['jumlah_rw'] ?? '') }}" required>
                                    @error('jumlah_rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batas_utara">Batas Utara</label>
                                    <input type="text" name="batas_utara" id="batas_utara" class="form-control @error('batas_utara') is-invalid @enderror" value="{{ old('batas_utara', $profilDesa->data_wilayah['batas_utara'] ?? '') }}" required>
                                    @error('batas_utara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batas_selatan">Batas Selatan</label>
                                    <input type="text" name="batas_selatan" id="batas_selatan" class="form-control @error('batas_selatan') is-invalid @enderror" value="{{ old('batas_selatan', $profilDesa->data_wilayah['batas_selatan'] ?? '') }}" required>
                                    @error('batas_selatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batas_timur">Batas Timur</label>
                                    <input type="text" name="batas_timur" id="batas_timur" class="form-control @error('batas_timur') is-invalid @enderror" value="{{ old('batas_timur', $profilDesa->data_wilayah['batas_timur'] ?? '') }}" required>
                                    @error('batas_timur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batas_barat">Batas Barat</label>
                                    <input type="text" name="batas_barat" id="batas_barat" class="form-control @error('batas_barat') is-invalid @enderror" value="{{ old('batas_barat', $profilDesa->data_wilayah['batas_barat'] ?? '') }}" required>
                                    @error('batas_barat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4>Peta dan Koordinat</h4>
                                <hr>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="number" step="any" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $profilDesa->latitude ?? '') }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="number" step="any" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $profilDesa->longitude ?? '') }}">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="peta_embed">Embed Peta (iframe)</label>
                                    <textarea name="peta_embed" id="peta_embed" class="form-control @error('peta_embed') is-invalid @enderror" rows="4" placeholder="Masukkan kode embed peta dari Google Maps">{{ old('peta_embed', $profilDesa->peta_embed ?? '') }}</textarea>
                                    @error('peta_embed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
