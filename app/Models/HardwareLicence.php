<?php

namespace App\Models;

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
class HardwareLicence extends Pivot
{
    use HasFactory, Tenantable;

    protected $fillable = [
        'files',
        'notes',
        'team_id',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function hardware(): BelongsTo
    {
        return $this->belongsTo(Hardware::class);
    }

    public function licence(): BelongsTo
    {
        return $this->belongsTo(Licence::class);
    }
}
