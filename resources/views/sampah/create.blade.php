@extends('layouts.app')

@section('title', 'Tambah Jenis Sampah')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tambah Jenis Sampah Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('sampah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Sampah</label>
                            <input type="text" class="form-control @error('jenis') is-invalid @enderror" 
                                   id="jenis" name="jenis" value="{{ old('jenis') }}" required>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Plastik" {{ old('kategori') == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                                <option value="Kertas" {{ old('kategori') == 'Kertas' ? 'selected' : '' }}>Kertas</option>
                                <option value="Logam" {{ old('kategori') == 'Logam' ? 'selected' : '' }}>Logam</option>
                                <option value="Kaca" {{ old('kategori') == 'Kaca' ? 'selected' : '' }}>Kaca</option>
                                <option value="Organik" {{ old('kategori') == 'Organik' ? 'selected' : '' }}>Organik</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="harga_per_kg" class="form-label">Harga per kg (Rp)</label>
                            <input type="number" class="form-control @error('harga_per_kg') is-invalid @enderror" 
                                   id="harga_per_kg" name="harga_per_kg" value="{{ old('harga_per_kg') }}" required>
                            @error('harga_per_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control @error('foto') is-invalid @enderror" 
                                   type="file" id="foto" name="foto" accept="image/*">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPEG, PNG, JPG (Max 2MB)</small>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('sampah.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection