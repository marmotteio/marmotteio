<?php

namespace App\Filament\Resources\HardwareStatusResource\Pages;

use App\Filament\Resources\HardwareStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHardwareStatuses extends ListRecords
{
    protected static string $resource = HardwareStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
