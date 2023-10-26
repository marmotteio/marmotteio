<?php

namespace App\Filament\Resources\AlertsResource\Pages;

use App\Filament\Resources\AlertsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlerts extends EditRecord
{
    protected static string $resource = AlertsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
