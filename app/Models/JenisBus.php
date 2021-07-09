<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBus extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function bus()
    {
        return $this->hasMany(Bus::class);
    }
}
