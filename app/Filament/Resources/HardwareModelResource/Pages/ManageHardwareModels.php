<?php

namespace App\Filament\Resources\HardwareModelResource\Pages;

use App\Filament\Resources\HardwareModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHardwareModels extends ManageRecords
{
    protected static string $resource = HardwareModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
