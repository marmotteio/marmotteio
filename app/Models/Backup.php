<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
    ];
}
