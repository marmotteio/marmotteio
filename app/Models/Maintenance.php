<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\HasUniqueIdentifier;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory, HasTeam, HasUniqueIdentifier, Tenantable;

    protected $fillable = [
        'hardware_id',
        'maintenance_type',
        'maintenance_date',
        'performed_by',
        'cost',
        'team_id',
        'files',
        'notes',
        'qr_code',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function hardware(): BelongsTo
    {
        return $this->belongsTo(Hardware::class);
    }
}
