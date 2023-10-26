<?php

namespace App\Filament\Resources\HardwareResource\Pages;

use App\Filament\Resources\HardwareResource;
use App\Models\Hardware;
use App\Models\HardwareStatus;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListHardware extends ListRecords
{
    protected static string $resource = HardwareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $statuses = HardwareStatus::withCount('hardware')
            ->orderByDesc('hardware_count')
            ->limit(7)
            ->get();

        $tabs = [];

        foreach ($statuses as $status) {
            $tabs[$status->name] = Tab::make($status->name)
                ->modifyQueryUsing(fn (Builder $query) => $query->withStatus($status->name))
                ->badge($status->hardware_count);
        }

        return [
            'all' => Tab::make('All Hardware')->badge(Hardware::count()),
            ...$tabs,
        ];
    }
}
