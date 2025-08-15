<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    // app/Models/Nasabah.php

protected $fillable = [
    'foto',
    'nama', 
    'alamat',
    'no_telepon',
    'email'
];

// Add accessor for easy display
public function getNamaLengkapAttribute()
{
    return $this->nama . ($this->no_telepon ? ' - ' . $this->no_telepon : '');
}
}   