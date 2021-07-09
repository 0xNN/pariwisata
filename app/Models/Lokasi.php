<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function paket_lokasi()
    {
        return $this->hasMany(PaketLokasi::class);
    }
}
