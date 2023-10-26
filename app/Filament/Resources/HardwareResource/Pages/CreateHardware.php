<?php

namespace App\Filament\Resources\HardwareResource\Pages;

use App\Filament\Resources\HardwareResource;
use App\Traits\HasCustomFields;
use Filament\Resources\Pages\CreateRecord;

class CreateHardware extends CreateRecord
{
    use HasCustomFields;

    protected static string $resource = HardwareResource::class;
}
