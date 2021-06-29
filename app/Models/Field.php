<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    protected  $guarded = [];
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
    public function enterpriseFields(): HasMany
    {
        return $this->hasMany(EnterpriseField::class);
    }

    /**
     * @return array
     */
    public function ScopeEnterprises():array{
        $enterprises = array();
        foreach ($this->enterpriseFields() as $value){
            array_merge($enterprises,$value->enterprises());
        }
        return $enterprises;
    }
}
