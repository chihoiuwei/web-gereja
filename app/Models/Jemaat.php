<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MinistryMember;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jemaat extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'birth_date',
        'gender',
        'phone',
        'address',
        'bio',
        'is_active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function ministryMembers(): HasMany {
        return $this->hasMany(MinistryMember::class);
    }
}
