<?php

namespace App\Filament\Resources\ComponentResource\Pages;

use App\Filament\Resources\ComponentResource;
use App\Traits\HasCustomFields;
use Filament\Resources\Pages\CreateRecord;

class CreateComponent extends CreateRecord
{
    use HasCustomFields;

    protected static string $resource = ComponentResource::class;
}
