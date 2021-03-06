<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
