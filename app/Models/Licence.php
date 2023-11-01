<?php

namespace App\Models;

use App\Traits\HasTeam;
use App\Traits\HasUniqueIdentifier;
use App\Traits\NotifiesOnModelChange;
use App\Traits\Quantifiable;
use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static count()
 * @method static create(array $array)
 */
class Licence extends Model
{
    use HasFactory, HasTeam, HasUniqueIdentifier, NotifiesOnModelChange, Quantifiable, Tenantable;

    protected $quantifiableRelationships = ['hardware', 'people'];

    protected $fillable = [
        'name',
        'quantity',
        'threshold',
        'licensed_to_name',
        'licensed_to_email',
        'product_key',
        'purchase_date',
        'order_number',
        'purchase_cost',
        'department_id',
        'supplier_id',
        'location_id',
        'manufacturer_id',
        'team_id',
        'files',
        'notes',
        'qr_code',
    ];

    protected $casts = [
        'files' => 'array',
    ];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)->withTimestamps()->using(LicencePerson::class)->withPivot('id', 'team_id', 'checked_in_at', 'checked_out_at');
    }

    public function hardware(): BelongsToMany
    {
        return $this->belongsToMany(Hardware::class)->withTimestamps()->using(HardwareLicence::class)->withPivot('id', 'team_id', 'checked_in_at', 'checked_out_at');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
