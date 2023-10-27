<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory, HasTeam, Tenantable;

    protected $fillable = [
        'name',
        'files',
        'notes',
    ];

    protected $casts = [
        'files' => 'array',
    ];
}
