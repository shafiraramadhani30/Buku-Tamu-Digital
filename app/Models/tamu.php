<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'alamat', 
        'jenis_kelamin', 
        'no_telp', 
        'email', 
        'pesan', 
        'ruangan_id',
        'jam_keluar'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}