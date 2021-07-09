<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function hotel_detail()
    {
        return $this->hasMany(HotelDetail::class);
    }

    public function lokasi()
    {
        return $this->hasOne(Lokasi::class);
    }
}
