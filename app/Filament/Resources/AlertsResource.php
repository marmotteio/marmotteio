<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlertsResource\Pages;
use App\Models\Alert;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AlertsResource extends Resource
{
    protected static ?string $model = Alert::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'danger' : 'primary';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Alert::query())
            ->columns([
                TextColumn::make('record')
                    ->label('Record type')
                    ->badge(),
                TextColumn::make('record_name')
                    ->badge()
                    ->url(fn (Alert $record) => '/admin/'.Filament::getTenant()->id.'/'.$record->record_url."/$record->record_id/edit")
                    ->iconPosition('after')
                    ->icon('heroicon-o-arrow-right'),
                TextColumn::make('threshold')
                    ->alignRight(),
                TextColumn::make('quantity_left')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->quantity_left.' out of '.$record->quantity)
                    ->alignRight(),
            ])
            ->filters([
                //
            ])
            ->actions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlerts::route('/'),
        ];
    }
}
