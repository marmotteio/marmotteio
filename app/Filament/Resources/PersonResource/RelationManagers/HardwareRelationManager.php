<?php

namespace App\Filament\Resources\PersonResource\RelationManagers;

use App\Models\Hardware;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HardwareRelationManager extends RelationManager
{
    protected static string $relationship = 'hardware';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->hardware()->count();
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
                TextColumn::make('hardware_model.name')
                    ->badge()
                    ->url(fn (Hardware $record) => '/admin/'.Filament::getTenant()->id."/hardware/$record->hardware_id/edit")
                    ->iconPosition('after')
                    ->searchable()
                    ->icon('heroicon-o-arrow-right'),

                TextColumn::make('hardware_status.name')
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->iconPosition('after'),
                TextColumn::make('serial_number')->sortable()->alignRight()->searchable()->badge()->color('info'),
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
                    ->label('Attach a hardware'),
            ])
            ->actions([
                // ...
                Tables\Actions\Action::make('check_in')
                    ->label('Detach')
                    ->action(function (Hardware $record) {
                        $record->pivot->find($record->pivot_id)->touch('checked_in_at');
                    })
                    ->requiresConfirmation()
                    ->visible(function (Hardware $record) {
                        return empty($record->checked_in_at);
                    }),
            ]);
    }
}
