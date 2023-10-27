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
 * @method static whereLicenceId(mixed $id)
 */
class LicencePerson extends Pivot
{
    use HasFactory, HasTeam, Tenantable;

    protected $fillable = [
        'files',
        'notes',
        'team_id',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function licence(): BelongsTo
    {
        return $this->belongsTo(Licence::class);
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
