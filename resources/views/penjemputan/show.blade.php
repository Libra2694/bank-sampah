@extends('layouts.app')

@section('title', 'Detail Penjemputan')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Detail Penjemputan Sampah</h4>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Informasi Nasabah</h5>
                    <table class="table table-sm">
                        <tr>
                            <th width="30%">Nama Nasabah</th>
                            <td>{{ $penjemputan->nasabah->nama }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $penjemputan->nasabah->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $penjemputan->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Penjemputan</h5>
                    <table class="table table-sm">
                        <tr>
                            <th width="30%">Tanggal</th>
                            <td>{{ $penjemputan->tanggal->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
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
                        </tr>
                        <tr>
                            <th>Petugas</th>
                            <td>{{ $penjemputan->petugas ? $penjemputan->petugas->nama : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $penjemputan->catatan ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('penjemputan.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('penjemputan.edit', $penjemputan->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection