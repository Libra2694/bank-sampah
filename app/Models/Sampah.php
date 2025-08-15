<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = [
        'jenis', 
        'kategori', 
        'harga_per_kg', 
        'deskripsi', 
        'foto'
    ];

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset($this->foto) : asset('images/default-sampah.jpg');
    }
    
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
