<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $array)
 */
class HardwareStatus extends Model
{
    use HasFactory, HasTeam, Tenantable;

    protected $fillable = [
        'name',
        'team_id',
        'files',
        'notes',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function hardware(): HasMany
    {
        return $this->hasMany(Hardware::class);
    }
}
