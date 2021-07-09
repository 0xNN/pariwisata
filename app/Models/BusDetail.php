<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

        /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFotoAttribute($value)
    {
        $this->attributes['foto'] = json_encode($value);
    }
}
