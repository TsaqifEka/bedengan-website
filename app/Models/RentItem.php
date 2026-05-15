<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentItem extends Model
{
    protected $guarded = [];

    public function equipment() {
        return $this->belongsTo(Equipment::class);
    }

    public function rent() {
        return $this->belongsTo(Rent::class);
    }
}
