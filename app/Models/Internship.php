<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMOne;

class Internship extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function enterprise(){
        return $this->belongsTo(Enterprise::class);
    }

    /**
     * @return BelongsTo
     */
    public function field(){
        return $this->belongsTo(Field::class);
    }

}
