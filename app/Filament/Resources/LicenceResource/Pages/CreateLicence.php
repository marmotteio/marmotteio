<?php

namespace App\Filament\Resources\LicenceResource\Pages;

use App\Filament\Resources\LicenceResource;
use App\Traits\HasCustomFields;
use Filament\Resources\Pages\CreateRecord;

class CreateLicence extends CreateRecord
{
    use HasCustomFields;

    protected static string $resource = LicenceResource::class;
}
