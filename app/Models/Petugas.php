<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_telepon',
        'email',
        'foto',
        'status'
    ];

    public function penjemputans()
    {
        return $this->hasMany(Penjemputan::class, 'petugas_id');
    }
}