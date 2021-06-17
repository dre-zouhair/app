<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function intern():BelongsTo
    {
        return $this->belongsTo(Intern::class);
    }

}
