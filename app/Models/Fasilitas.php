<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ruangan;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama', 'foto'
    ];

    public function ruangan()
    {
        return $this->belongsToMany(Ruangan::class);
    }
   
}
