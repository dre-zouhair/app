<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function internships(): HasMany
    {
        return $this->hasMany(Internship::class);
    }

    /**
     * @return HasMany
     */
    public function entreprisesFields(): HasMany
    {
        return $this->hasMany(EnterpriseField::class);
    }

    /**
     * @return array
     */
    public function ScopeEnterprises():array{
        $enterprises = array();
        foreach ($this->entreprisesFields() as $value){
            array_merge($enterprises,$value->entreprises());
        }
        return $enterprises;
    }
}
