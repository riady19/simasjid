<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zakat extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'payer_name',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
}
