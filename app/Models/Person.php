<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\HasUniqueIdentifier;
use App\Traits\Quantifiable;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static count()
 * @method static create(string[] $array)
 *
 * @property mixed $checked_out_at
 * @property mixed $pivot
 */
class Person extends Model
{
    use HasFactory, HasTeam, HasUniqueIdentifier, Quantifiable, Tenantable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'team_id',
        'files',
        'notes',
        'qr_code',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function consumables(): BelongsToMany
    {
        return $this->belongsToMany(Consumable::class)->withTimestamps()->using(ConsumablePerson::class)->withPivot('team_id', 'id', 'checked_in_at', 'checked_out_at');
    }

    public function licences(): BelongsToMany
    {
        return $this->belongsToMany(Licence::class)->withTimestamps()->using(LicencePerson::class)->withPivot('team_id', 'id', 'checked_in_at', 'checked_out_at');
    }

    public function hardware(): BelongsToMany
    {
        return $this->belongsToMany(Hardware::class)->withTimestamps()->using(HardwarePerson::class)->withPivot('team_id', 'id', 'checked_in_at', 'checked_out_at');
    }
}
