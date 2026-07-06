<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\HargaSewa;

class BookingStudio extends Model
{
    use HasFactory;

    protected $table = 'booking_studio';

    protected $fillable = [
        'user_id',
        'kode_booking',
        'nama_pemesan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruangan_id',
        'status',
    ];

    /**
     * Relasi ke user yang melakukan booking
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'booking_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }


    // public function ruanganModel()
    // {
    //     return $this->belongsTo(Ruangan::class, 'ruangan_id');
    // }

}
