<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment'; // Karena singular equipment tidak punya plural standard
    protected $guarded = [];
}
