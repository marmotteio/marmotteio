<?php

namespace App\Filament\Resources\HardwareResource\RelationManagers;

use App\Models\Licence;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class LicencesRelationManager extends RelationManager
{
    protected static string $relationship = 'licences';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->licences()->count();
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
                TextColumn::make('name')
                    ->badge()
                    ->url(fn (Licence $record) => '/admin/'.Filament::getTenant()->id."/licences/$record->licence_id/edit")
                    ->getStateUsing(fn (Licence $record): string => $record->name)
                    ->iconPosition('after')
                    ->searchable()
                    ->icon('heroicon-o-arrow-right'),
                TextColumn::make('licensed_to_name')->searchable(),
                TextColumn::make('product_key')->badge()->color('info')->searchable(),
                TextColumn::make('checked_out_at')->label('Checked out at')->alignRight(),
                TextColumn::make('checked_in_at')->label('Checked in at')->alignRight(),
            ])
            ->filters([
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->label('Attach a licence'),
            ])
            ->actions([
                Tables\Actions\Action::make('check_in')
                    ->label('Detach')
                    ->action(function (Licence $record) {
                        $record->pivot->find($record->pivot_id)->touch('checked_in_at');
                    })
                    ->requiresConfirmation()
                    ->visible(function (Licence $record) {
                        return empty($record->checked_in_at);
                    }),
            ]);
    }
}
