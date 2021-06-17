<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnterpriseField extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function entreprises(){
        return $this->hasMany(Enterprise::class);
    }

    /**
     * @return HasMany
     */
    public function fields(){
        return $this->hasMany(Field::class);
    }

}
