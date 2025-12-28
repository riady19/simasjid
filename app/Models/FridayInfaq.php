<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FridayInfaq extends Model
{
    protected $fillable = [
        'date',
        'amount',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
