<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enterprise extends Model
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
    public function enterpriseFields():HasMany{
        return $this->hasMany(EnterpriseField::class);
    }

    /**
     * @return array
     */
    public function ScopeFields():array{
        $fields = array();
        foreach ($this->enterpriseFields() as $value){
            array_merge($fields,$value->fields());
        }
        return $fields;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
