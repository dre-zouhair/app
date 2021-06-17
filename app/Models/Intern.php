<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions(){
        return $this->hasMany(Submission::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trainings(){
        return $this->hasMany(Training::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experiences(){
        return $this->hasMany(Experience::class);
    }
}
