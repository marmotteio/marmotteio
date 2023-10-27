<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 */
class Supplier extends Model
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
}
