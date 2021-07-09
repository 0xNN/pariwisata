<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function pesawat()
    {
        return $this->belongsTo(Pesawat::class);
    }

    public function paket_lokasi()
    {
        return $this->hasMany(PaketLokasi::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }
}
