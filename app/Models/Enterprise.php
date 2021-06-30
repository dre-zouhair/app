<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enterprise extends Model
{
    use HasFactory;

    //This attribute is used to indicate which attributes are not mass assignable
    //i.e cannot be passed as a part of an array of data to create an object/record in the database.
    protected  $guarded = [];

    /**
     * We define associations to mimic the foreign keys constraints in the database
     * Laravel ORM, Eloquent dynamically understand and load the data from the database for each association using the foreign keys
     * Hens Models are a representation of the SQL Schema of our database
     * In this example, each enterprise has many internships, that are associated to it via a foreign key
     * So to get the internships of $enterprise we use the following code :  $enterprise->internships()->getResults()
     * this will return an array of objects of the Model Internship
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

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
