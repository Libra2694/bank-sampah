@extends('layouts.app')

@section('title', 'Nasabah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Nasabah</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('nasabah.create') }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus me-1"></i> Tambah Nasabah
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($nasabahs as $nasabah)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($nasabah->foto)
                            <img src="{{ asset('storage/' . $nasabah->foto) }}" alt="{{ $nasabah->nama }}" width="50" class="img-thumbnail">
                            
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                        
                    </td>
                    <td>{{ $nasabah->nama }}</td>
                    <td>{{ Str::limit($nasabah->alamat, 30) }}</td>
                    <td>{{ $nasabah->no_telepon }}</td>
                    <td>{{ $nasabah->email ?? '-' }}</td>
                    <td>
                        <a href="{{ route('nasabah.show', $nasabah->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('nasabah.edit', $nasabah->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('nasabah.destroy', $nasabah->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data nasabah ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data nasabah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $nasabahs->links() }}
        </div>
    </div>
</div>
@endsection