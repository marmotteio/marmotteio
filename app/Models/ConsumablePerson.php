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
 * @method static whereNotNull(string $string)
 * @method static whereConsumableId(mixed $id)
 */
class ConsumablePerson extends Pivot
{
    use HasFactory, HasTeam, Tenantable;

    protected $fillable = [
        'files',
        'notes',
        'checked_out_at',
        'team_id',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function consumable(): BelongsTo
    {
        return $this->belongsTo(Consumable::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
