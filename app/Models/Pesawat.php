<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesawat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function paket()
    {
        return $this->hasOne(Paket::class);
    }

    public function pesawat_detail()
    {
        return $this->hasMany(PesawatDetail::class);
    }
}
