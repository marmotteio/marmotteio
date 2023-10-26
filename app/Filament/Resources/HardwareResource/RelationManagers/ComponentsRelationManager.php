<?php

namespace App\Filament\Resources\HardwareResource\RelationManagers;

use App\Models\Component;
use Filament\Facades\Filament;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ComponentsRelationManager extends RelationManager
{
    protected static string $relationship = 'components';

    protected bool $allowsDuplicates = true;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->components()->count();
    }

    public function table(Table $table): Table
    {
        return $table
            ->allowDuplicates()
            ->columns([
                TextColumn::make('name')
                    ->badge()
                    ->url(fn (Component $record) => '/admin/'.Filament::getTenant()->id."/components/$record->component_id/edit")
                    ->getStateUsing(fn (Component $record): string => $record->name)
                    ->iconPosition('after')
                    ->searchable()
                    ->icon('heroicon-o-arrow-right'),

                TextColumn::make('model_number')->badge()->color('info')->searchable(),
                TextColumn::make('checked_out_at')->label('Checked out at')->alignRight(),
                TextColumn::make('checked_in_at')->label('Checked in at')->alignRight(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ...
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Attach a component'),
            ])
            ->actions([
                // ...
                Tables\Actions\Action::make('check_in')
                    ->label('Detach')
                    ->action(function (Component $record) {
                        $record->pivot->find($record->pivot_id)->touch('checked_in_at');
                    })
                    ->requiresConfirmation()
                    ->visible(function (Component $record) {
                        return empty($record->checked_in_at);
                    }),
            ]);
    }
}
