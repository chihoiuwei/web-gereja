<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinistryMember extends Model {

        protected $fillable = [
        'jemaat_id',
        'ministry_id',
        'position',
        'is_active',
    ];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public function ministry(): BelongsTo{
        return $this->belongsTo(Ministry::class);
    }

      public function jemaat() {
        return $this->belongsTo(Jemaat::class);
    }

}
