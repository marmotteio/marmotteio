<?php

namespace App\Filament\Resources\ConsumableResource\Pages;

use App\Filament\Resources\ConsumableResource;
use App\Traits\HasCustomFields;
use Filament\Resources\Pages\CreateRecord;

class CreateConsumable extends CreateRecord
{
    use HasCustomFields;

    protected static string $resource = ConsumableResource::class;
}
