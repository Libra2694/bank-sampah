@extends('layouts.app')

@section('title', 'Daftar Penjemputan')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penjemputan Sampah</h6>
            <a href="{{ route('penjemputan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Buat Penjemputan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nasabah</th>
                            <th>Petugas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penjemputans as $penjemputan)
                        <tr>
                            <td>{{ $loop->iteration + ($penjemputans->currentPage() - 1) * $penjemputans->perPage() }}</td>
                            <td>{{ $penjemputan->tanggal->format('d M Y') }}</td>
                            <td>{{ $penjemputan->nasabah->nama }}</td>
                            <td>{{ $penjemputan->petugas ? $penjemputan->petugas->nama : '-' }}</td>
                            <td>
                                <span class="badge 
                                    @if($penjemputan->status == 'menunggu') bg-secondary
                                    @elseif($penjemputan->status == 'diproses') bg-warning text-dark
                                    @elseif($penjemputan->status == 'selesai') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($penjemputan->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('penjemputan.show', $penjemputan->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penjemputan.edit', $penjemputan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('penjemputan.destroy', $penjemputan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data penjemputan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data penjemputan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $penjemputans->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection