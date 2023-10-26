<?php

namespace App\Filament\Resources\HardwareResource\RelationManagers;

use App\Models\HardwarePerson;
use App\Models\Person;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PeopleRelationManager extends RelationManager
{
    protected static string $relationship = 'people';

    protected bool $allowsDuplicates = true;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->people()->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
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
                Tables\Columns\TextColumn::make('checked_in_at')->label('Checked in at')->alignRight(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ...
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->disabled(function (RelationManager $livewire) {
                        return HardwarePerson::whereHardwareId($livewire->ownerRecord->id)->whereNull('checked_in_at')->exists();
                    })
                    ->label('Attach to a person'),
            ])
            ->actions([
                // ...
                Tables\Actions\Action::make('check_in')
                    ->label('Detach')
                    ->action(function (Person $record) {
                        $record->pivot->find($record->pivot_id)->touch('checked_in_at');
                    })
                    ->requiresConfirmation()
                    ->visible(function (Person $record) {
                        return empty($record->checked_in_at);
                    }),
                //Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
