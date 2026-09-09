<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
     protected $fillable = [
        'title',
        'photo',
        'description',
        'taken_at',
        'is_active',
    ];

    protected $casts = [
        'taken_at' => 'date',
        'is_active' => 'boolean',
    ];
}
