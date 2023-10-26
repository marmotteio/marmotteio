<?php

namespace App\Filament\Resources\ConsumableResource\Pages;

use App\Filament\Resources\ConsumableResource;
use App\Traits\HasCustomFields;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsumable extends EditRecord
{
    use HasCustomFields;

    protected static string $resource = ConsumableResource::class;

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
