<?php

namespace App\Models;

use App\Traits\HasTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory, HasTeam;

    protected $fillable = ['name', 'field_type', 'applicable_model'];

    public function values()
    {
        return $this->hasMany(CustomFieldValue::class);
    }
}
