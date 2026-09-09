<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = [
        'name',
        'photo',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'description',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];
}
