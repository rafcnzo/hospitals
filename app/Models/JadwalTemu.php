<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalTemu extends Model
{
    protected $table = 'jadwal_temu';
    protected $primaryKey = 'idjadwal_temu';
    protected $guarded = [];

    // Biar otomatis jadi objek Carbon (bisa $item->waktu_temu->format('d M Y'))
    protected $casts = [
        'waktu_temu' => 'datetime',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }
}
