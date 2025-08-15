@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Sampah</h6>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Transaksi Baru
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
                            <th>Jenis Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Harga/Kg</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}</td>
                            <td>{{ $transaksi->tanggal->format('d/m/Y') }}</td>
                            <td>{{ $transaksi->nasabah->nama }}</td>
                            <td>{{ $transaksi->sampah->nama }}</td>
                            <td>{{ number_format($transaksi->berat_kg, 2) }}</td>
                            <td>Rp {{ number_format($transaksi->harga_per_kg) }}</td>
                            <td>Rp {{ number_format($transaksi->total) }}</td>
                            <td>
                                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $transaksis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection