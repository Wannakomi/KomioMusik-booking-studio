<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamOperasional extends Model
{
    protected $table = 'jam_operasional';

    protected $fillable = [
        'hari',
        'jam_buka',
        'jam_tutup',
        'status',
    ];

    /**
     * Scope untuk hari tertentu, misal: JamOperasional::hari('Senin')->first();
     */
    public function scopeHari($query, $hari)
    {
        return $query->where('hari', $hari);
    }

    /**
     * Helper: format jam dalam format H:i (08:00)
     */
    public function getJamBukaFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->jam_buka)->format('H:i');
    }

    public function getJamTutupFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->jam_tutup)->format('H:i');
    }

    /**
     * Cek apakah waktu tertentu berada di dalam rentang jam operasional
     */
    public function isWithinOperationalHours($time)
    {
        $time = \Carbon\Carbon::parse($time)->format('H:i:s');
        return $time >= $this->jam_buka && $time <= $this->jam_tutup;
    }
}
