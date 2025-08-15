<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nasabah_id',
        'sampah_id',
        'berat_kg',
        'harga_per_kg',
        'total'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'berat_kg' => 'decimal:2'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }
}