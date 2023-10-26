<?php

namespace App\Traits;

use App\Models\CustomFieldValue;
use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTeam
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function customFieldValues()
    {
        return $this->morphMany(CustomFieldValue::class, 'model');
    }
}
