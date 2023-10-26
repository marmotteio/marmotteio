<?php

namespace App\Filament\Widgets;

use App\Models\Component;
use App\Models\Consumable;
use App\Models\Hardware;
use App\Models\Licence;
use App\Models\Maintenance;
use App\Models\Person;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = -100;

    protected int|string|array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Hardware', Hardware::count()),
            Stat::make('Licences', Licence::count()),
            Stat::make('Consumables', Consumable::count()),
            Stat::make('Components', Component::count()),
            Stat::make('People', Person::count()),
            Stat::make('Maintenances', Maintenance::count()),
        ];
    }
}
