<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function jenis_bus()
    {
        return $this->belongsTo(JenisBus::class);
    }

    public function bus_detail()
    {
        return $this->hasMany(BusDetail::class);
    }
}
