<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $guarded = [];

    // Transaksi ini milik siapa?
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Transaksi ini isinya barang apa saja?
    public function items() {
        return $this->hasMany(RentItem::class);
    }
}
