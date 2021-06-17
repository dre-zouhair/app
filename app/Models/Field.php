<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function internships(){
        return $this->hasMany(Internship::class);
    }

    /**
     * @return HasMany
     */
    public function entreprises(){
        return $this->hasMany(EnterpriseField::class);
    }
}
