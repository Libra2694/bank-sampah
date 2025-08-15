{{-- edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Nasabah')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Nasabah</h1>
    </div>

    <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $nasabah->nama) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $nasabah->alamat) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $nasabah->no_telepon) }}" required>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $nasabah->email) }}">
                </div>
                
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Foto Saat Ini</label>
                    <div>
                        @if($nasabah->foto)
                            <img src="{{ asset('storage/' . $nasabah->foto) }}" alt="Foto Nasabah" class="img-thumbnail" width="150">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('nasabah.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
    // Preview image before upload
    document.getElementById('foto').addEventListener('change', function(event) {
        const output = document.getElementById('foto-preview');
        if (event.target.files && event.target.files[0]) {
            output.classList.remove('d-none');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
        }
    });
</script>
@endsection