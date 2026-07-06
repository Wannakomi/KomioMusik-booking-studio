<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalStudio extends Model
{
    protected $fillable = [
        'ruangan_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'tersedia'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}


