@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Transaksi Sampah</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Transaksi</h5>
                    <table class="table table-sm">
                        <tr>
                            <th width="40%">Tanggal Transaksi</th>
                            <td>{{ $transaksi->tanggal->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>No. Transaksi</th>
                            <td>TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td class="fw-bold">Rp {{ number_format($transaksi->total) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Detail Sampah</h5>
                    <table class="table table-sm">
                        <tr>
                            <th width="40%">Jenis Sampah</th>
                            <td>{{ $transaksi->sampah->nama }}</td>
                        </tr>
                        <tr>
                            <th>Berat</th>
                            <td>{{ number_format($transaksi->berat_kg, 2) }} kg</td>
                        </tr>
                        <tr>
                            <th>Harga per Kg</th>
                            <td>Rp {{ number_format($transaksi->harga_per_kg) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <h5>Informasi Nasabah</h5>
                    <table class="table table-sm">
                        <tr>
                            <th width="20%">Nama Nasabah</th>
                            <td>{{ $transaksi->nasabah->nama }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $transaksi->nasabah->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $transaksi->nasabah->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus transaksi ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection