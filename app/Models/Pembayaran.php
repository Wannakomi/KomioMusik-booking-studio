<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';

    protected $table = 'pembayaran';

    protected $fillable = [
        'booking_id',
        'kode_booking',
        'nama_pemesan',
        'tanggal_booking',
        'total_pembayaran',
        'status',
        'bukti_pembayaran',
    ];

    public function booking()
    {
        return $this->belongsTo(BookingStudio::class, 'booking_id');
    }
}
