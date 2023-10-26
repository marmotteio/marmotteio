<?php

namespace App\Filament\Resources\DepreciationResource\Pages;

use App\Filament\Resources\DepreciationResource;
use App\Traits\HasCustomFields;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDepreciations extends ManageRecords
{
    use HasCustomFields;

    protected static string $resource = DepreciationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data) {
                    return $this->handleRecordCreation($data);
                }),
        ];
    }
}
