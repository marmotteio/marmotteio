<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponentResource\Pages;
use App\Filament\Resources\ComponentResource\RelationManagers\HardwareRelationManager;
use App\Filament\Resources\Shared\ClsmComponent;
use App\Filament\Resources\Shared\CreatedAtUpdatedAtComponent;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Filament\Resources\Shared\NcqComponent;
use App\Models\Component;
use App\Traits\HasCustomFields;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ComponentResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Component::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationGroup = 'Physical Assets';

    protected static ?int $navigationSort = 1;

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
        return ['id', 'qr_code', 'name', 'quantity', 'model_number', 'order_number', 'notes'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Model number' => $record->model_number,
            'Quantity' => $record->quantity,
            'Department' => $record->department?->name ?? 'Unknown',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                NcqComponent::render(),
                self::customFieldsSchema(self::getModel()),
                ClsmComponent::render(),

                Section::make('Purchase date & cost')
                    ->description('Please fill in the following form')
                    ->collapsible()
                    ->compact()
                    ->columns(4)
                    ->schema([
                        DatePicker::make('purchase_date'),
                        TextInput::make('purchase_cost')
                            ->numeric()
                            ->prefix(Filament::getTenant()->currency),
                        TextInput::make('model_number'),
                        TextInput::make('order_number'),
                    ]),

                ImagesAndNoteComponent::render(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->iconPosition('after')
                    ->searchable()->sortable(),
                TextColumn::make('quantity')
                    ->searchable()
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalQuantityLeft()." out of $state")
                    ->sortable()
                    ->color(fn (Model $record): string => $record->totalQuantityLeft() <= 0 ? 'danger' : 'gray')
                    ->alignRight()
                    ->label('Quantity'),
                TextColumn::make('hardware_count')
                    ->counts('hardware')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['hardware'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Hardware'),
                TextColumn::make('department.name')
                    ->searchable()
                    ->sortable()
                    ->alignRight(),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
