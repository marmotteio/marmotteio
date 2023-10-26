<?php

namespace App\Filament\Resources\HardwareStatusResource\Pages;

use App\Filament\Resources\HardwareStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHardwareStatuses extends ManageRecords
{
    protected static string $resource = HardwareStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
