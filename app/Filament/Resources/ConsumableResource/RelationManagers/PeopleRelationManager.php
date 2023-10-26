<?php

namespace App\Filament\Resources\ConsumableResource\RelationManagers;

use App\Models\Person;
use Filament\Facades\Filament;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->people()->count();
    }

    public function table(Table $table): Table
    {
        return $table
            ->allowDuplicates()
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->badge()
                    ->searchable()
                    ->url(fn (Person $record) => '/admin/'.Filament::getTenant()->id."/people/$record->person_id/edit")
                    ->getStateUsing(fn (Person $record): string => $record->name)
                    ->iconPosition('after')
                    ->icon('heroicon-o-arrow-right'),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('checked_out_at')->label('Checked out at')->alignRight(),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Attach a Person'),
            ]);
    }
}
