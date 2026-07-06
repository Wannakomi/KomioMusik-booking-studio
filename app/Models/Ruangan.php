<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fasilitas;
use App\Models\HargaSewa;

class Ruangan extends Model
{
    protected $table = 'ruangan';

    protected $fillable = [
        'nama', 'deskripsi', 'foto'
    ];

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class);
    }


    public function hargaSewas()
    {
        return $this->hasMany(HargaSewa::class, 'ruangan_id');
    }

}
