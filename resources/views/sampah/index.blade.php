@extends('layouts.app')

@section('title', 'Jenis Sampah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Jenis Sampah</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('sampah.create') }}" class="btn btn-sm btn-success">
                <i class="fas fa-plus me-1"></i> Tambah Jenis
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
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Harga/kg</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sampahs as $sampah)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($sampah->foto)
                            {{-- <img src="{{ $sampah->foto }}" alt="{{ $sampah->jenis }}" width="50" class="img-thumbnail"> --}}
                            {{-- <img src="{{ asset($sampah->foto) }}" width="40" alt="{{ $sampah->jenis }}"> --}}
                            <img src="{{ asset('storage/' . $sampah->foto) }}" width="60" alt="{{ $sampah->jenis }}">



                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $sampah->jenis }}</td>
                    <td>{{ $sampah->kategori }}</td>
                    <td>Rp {{ number_format($sampah->harga_per_kg, 0, ',', '.') }}</td>
                    <td>{{ Str::limit($sampah->deskripsi, 50) }}</td>
                    <td>
                        <a href="{{ route('sampah.edit', $sampah->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('sampah.destroy', $sampah->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus jenis sampah ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data jenis sampah</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection