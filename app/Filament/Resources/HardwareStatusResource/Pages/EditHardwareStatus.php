<?php

namespace App\Filament\Resources\HardwareStatusResource\Pages;

use App\Filament\Resources\HardwareStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHardwareStatus extends EditRecord
{
    protected static string $resource = HardwareStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
