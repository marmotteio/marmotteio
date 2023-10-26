<?php

namespace App\Filament\Resources\LicenceResource\Pages;

use App\Filament\Resources\LicenceResource;
use App\Traits\HasCustomFields;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLicence extends EditRecord
{
    use HasCustomFields;

    protected static string $resource = LicenceResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
