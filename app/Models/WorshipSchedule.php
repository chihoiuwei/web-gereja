<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorshipSchedule extends Model
{
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'end_time',
        'description',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}