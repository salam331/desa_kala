@extends('layouts.admin')

@section('title', 'Edit Struktur Pemerintahan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Anggota Struktur Pemerintahan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.struktur-pemerintahan.update', $struktur->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $struktur->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $struktur->jabatan) }}" required>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="urutan">Urutan</label>
                                    <input type="number" name="urutan" id="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $struktur->urutan) }}" min="0" required>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Urutan tampilan (0 = teratas)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active', $struktur->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $struktur->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    @if($struktur->foto)
                                        <div class="mb-2">
                                            <img src="{{ asset($struktur->foto) }}" alt="{{ $struktur->nama }}" class="img-thumbnail" width="100">
                                            <small class="form-text text-muted d-block">Foto saat ini</small>
                                        </div>
                                    @endif
                                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('admin.struktur-pemerintahan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
