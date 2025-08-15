@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Catat Transaksi Sampah Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                   value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nasabah_id" class="form-label">Nasabah <span class="text-danger">*</span></label>
                            <select name="nasabah_id" class="form-select @error('nasabah_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Nasabah</option>
                                @foreach($nasabahs as $nasabah)
                                    <option value="{{ $nasabah->id }}" {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>
                                        {{ $nasabah->nama }} - {{ $nasabah->no_telepon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nasabah_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sampah_id" class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                            <select name="sampah_id" id="sampah_id" class="form-select @error('sampah_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih Jenis Sampah</option>
                                @foreach($sampahs as $sampah)
                                    <option value="{{ $sampah->id }}" data-harga="{{ $sampah->harga_per_kg }}" 
                                        {{ old('sampah_id') == $sampah->id ? 'selected' : '' }}>
                                        {{ $sampah->nama }} (Rp {{ number_format($sampah->harga_per_kg) }}/kg)
                                    </option>
                                @endforeach
                            </select>
                            @error('sampah_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga_per_kg" class="form-label">Harga per Kg <span class="text-danger">*</span></label>
                            <input type="number" name="harga_per_kg" id="harga_per_kg" 
                                   class="form-control @error('harga_per_kg') is-invalid @enderror" 
                                   value="{{ old('harga_per_kg') }}" min="1" required>
                            @error('harga_per_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="berat_kg" class="form-label">Berat (kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="berat_kg" id="berat_kg" 
                                   class="form-control @error('berat_kg') is-invalid @enderror" 
                                   value="{{ old('berat_kg') }}" min="0.1" required>
                            @error('berat_kg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" id="total" class="form-control bg-light" readonly>
                            <small class="text-muted">Total akan dihitung otomatis</small>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sampahSelect = document.getElementById('sampah_id');
        const hargaInput = document.getElementById('harga_per_kg');
        const beratInput = document.getElementById('berat_kg');
        const totalInput = document.getElementById('total');

        // Update harga ketika jenis sampah dipilih
        sampahSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            hargaInput.value = harga;
            calculateTotal();
        });

        // Hitung total ketika berat atau harga berubah
        beratInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);

        function calculateTotal() {
            const berat = parseFloat(beratInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const total = berat * harga;
            totalInput.value = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Hitung total saat pertama kali load
        calculateTotal();
    });
</script>
@endpush
@endsection