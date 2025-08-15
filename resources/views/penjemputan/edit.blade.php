@extends('layouts.app')

@section('title', 'Edit Penjemputan')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Penjemputan Sampah</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('penjemputan.update', $penjemputan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nasabah_id" class="form-label">Nasabah <span class="text-danger">*</span></label>
                            <select name="nasabah_id" class="form-select @error('nasabah_id') is-invalid @enderror" required>
                                <option value="" disabled>Pilih Nasabah</option>
                                @foreach($nasabahs as $nasabah)
                                    <option value="{{ $nasabah->id }}" 
                                        {{ old('nasabah_id', $penjemputan->nasabah_id) == $nasabah->id ? 'selected' : '' }}>
                                        {{ $nasabah->nama }} - {{ $nasabah->no_telepon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nasabah_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Penjemputan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                   value="{{ old('tanggal', $penjemputan->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="petugas_id" class="form-label">Petugas</label>
                            <select name="petugas_id" class="form-select @error('petugas_id') is-invalid @enderror">
                                <option value="">Pilih Petugas</option>
                                @foreach($petugas as $p)
                                    <option value="{{ $p->id }}" 
                                        {{ old('petugas_id', $penjemputan->petugas_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->nama }} ({{ $p->no_telepon }})
                                    </option>
                                @endforeach
                            </select>
                            @error('petugas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="menunggu" {{ old('status', $penjemputan->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diproses" {{ old('status', $penjemputan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ old('status', $penjemputan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="batal" {{ old('status', $penjemputan->status) == 'batal' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Penjemputan <span class="text-danger">*</span></label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $penjemputan->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2">{{ old('catatan', $penjemputan->catatan) }}</textarea>
                    @error('catatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('penjemputan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection