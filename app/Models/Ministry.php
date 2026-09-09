<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ministry extends Model {

protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];


    public function members(): HasMany {
        return $this->hasMany(MinistryMember::class);
    }

    public function ministryMembers() {
        return $this->hasMany(MinistryMember::class);
    }
}
