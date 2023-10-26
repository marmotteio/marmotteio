<?php

namespace App\Filament\Resources\PersonResource\Pages;

use App\Filament\Resources\PersonResource;
use App\Traits\HasCustomFields;
use Filament\Resources\Pages\CreateRecord;

class CreatePerson extends CreateRecord
{
    use HasCustomFields;

    protected static string $resource = PersonResource::class;
}
