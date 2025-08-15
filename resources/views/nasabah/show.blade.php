@extends('layouts.app')

@section('title', 'Detail Nasabah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Nasabah</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('nasabah.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($nasabah->foto)
                        <img src="{{ asset('storage/' . $nasabah->foto) }}" alt="Foto Nasabah" class="img-thumbnail mb-3" width="200">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width:200px; height:200px; margin: 0 auto;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <h4>{{ $nasabah->nama }}</h4>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Nasabah</h5>
                    <hr>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Alamat:</div>
                        <div class="col-md-8">{{ $nasabah->alamat }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">No. Telepon:</div>
                        <div class="col-md-8">{{ $nasabah->no_telepon }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $nasabah->email ?? '-' }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Daftar:</div>
                        <div class="col-md-8">{{ $nasabah->created_at->format('d F Y H:i') }}</div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('nasabah.edit', $nasabah->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('nasabah.destroy', $nasabah->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data nasabah ini?')">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection