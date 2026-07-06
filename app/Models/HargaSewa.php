<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaSewa extends Model
{
    protected $fillable = [
        'harga',
        'tipe',
        'ruangan_id',
    ];
    
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    
}
