<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryAlbum extends Model
{
    protected $fillable = [
        'title',
        'description',
        'taken_at',
        'is_active',
    ];

    protected $casts = [
        'taken_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class);
    }
}