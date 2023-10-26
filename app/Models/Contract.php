<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Contract extends Model implements HasMedia
{
    use HasFactory, HasTeam, InteractsWithMedia, Tenantable;

    protected $fillable = [
        'name',
        'files',
        'notes',
    ];

    protected $casts = [
        'files' => 'array',
    ];
}
