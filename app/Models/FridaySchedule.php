<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FridaySchedule extends Model
{
    protected $fillable = [
        'date',
        'khotib',
        'khotib_photo',
        'imam',
        'imam_photo',
        'bilal',
        'bilal_photo',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
