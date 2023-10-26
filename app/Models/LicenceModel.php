<?php

namespace App\Models;

use App\Traits\HasTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenceModel extends Model
{
    use HasFactory, HasTeam;

    protected $fillable = [
        'files',
        'notes',
    ];

    protected $casts = [
        'files' => 'array',
    ];
}
