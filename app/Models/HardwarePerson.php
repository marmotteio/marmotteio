<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @method static create(string[] $array)
 * @method static first()
 * @method static whereHardwareId(mixed $id)
 * @method static whereNotNull(string $string)
 */
class HardwarePerson extends Pivot
{
    use HasFactory, HasTeam, Tenantable;

    protected $fillable = [
        'files',
        'notes',
        'team_id',
        'checked_in_at',
        'checked_out_at',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function hardware(): BelongsTo
    {
        return $this->belongsTo(Hardware::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
