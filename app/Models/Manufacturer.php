<?php

namespace App\Models;

use App\Traits\HasTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $array)
 */
class Manufacturer extends Model
{
    use HasFactory, HasTeam;

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
