<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonResource\Pages;
use App\Filament\Resources\PersonResource\RelationManagers\ConsumablesRelationManager;
use App\Filament\Resources\PersonResource\RelationManagers\HardwareRelationManager;
use App\Filament\Resources\PersonResource\RelationManagers\LicencesRelationManager;
use App\Filament\Resources\Shared\CreatedAtUpdatedAtComponent;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Models\Person;
use App\Traits\HasCustomFields;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PersonResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Person::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Business Components';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id', 'qr_code', 'name', 'phone', 'email', 'notes'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Phone' => $record->phone,
            'Email' => $record->email,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make('Basic information')
                        ->description('Provide details to facilitate accurate and effective tracking')
                        ->collapsible()
                        ->compact()
                        ->columns(3)
                        ->columnSpan(3)
                        ->schema([
                            TextInput::make('name')->required(),
                            TextInput::make('phone'),
                            TextInput::make('email'),
                        ]),
                    Section::make('QR Code')
                        ->columnSpan(1)
                        ->collapsible()
                        ->compact()
                        ->schema([ViewField::make('qr_code')->view('filament.components.qr_code')]),
                ])->columns(4),
                self::customFieldsSchema(self::getModel()),
                ImagesAndNoteComponent::render(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('phone')->sortable()->searchable(),
                TextColumn::make('hardware_count')
                    ->counts('hardware')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['hardware'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Hardware'),
                TextColumn::make('consumables_count')
                    ->counts('consumables')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['consumables'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Consumables'),
                TextColumn::make('licences_count')
                    ->counts('licences')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['licences'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Licences'),
                ...CreatedAtUpdatedAtComponent::render(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                //FilamentExportHeaderAction::make('export'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            HardwareRelationManager::class,
            ConsumablesRelationManager::class,
            LicencesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeople::route('/'),
            'create' => Pages\CreatePerson::route('/create'),
            'edit' => Pages\EditPerson::route('/{record}/edit'),
        ];
    }
}
