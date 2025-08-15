<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjemputan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'petugas_id',
        'tanggal',
        'status',
        'alamat',
        'catatan'
    ];

    // ✅ Tambahkan ini
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
