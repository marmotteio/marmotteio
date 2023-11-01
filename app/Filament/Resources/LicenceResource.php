<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicenceResource\Pages;
use App\Filament\Resources\LicenceResource\RelationManagers\HardwareRelationManager;
use App\Filament\Resources\LicenceResource\RelationManagers\PeopleRelationManager;
use App\Filament\Resources\Shared\ClsmComponent;
use App\Filament\Resources\Shared\CreatedAtUpdatedAtComponent;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Filament\Resources\Shared\NcqComponent;
use App\Models\Licence;
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

class LicenceResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Licence::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Intangible Assets';

    protected static ?int $navigationSort = 2;

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
        return ['id', 'qr_code', 'name', 'quantity', 'product_key', 'order_number', 'notes', 'licensed_to_email', 'licensed_to_name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Product key' => $record->product_key,
            'Quantity' => $record->quantity,
            'Licensed to' => $record->licensed_to_email,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                NcqComponent::render(),
                self::customFieldsSchema(self::getModel()),
                ClsmComponent::render(),

                Section::make('License Ownership Registration')
                    ->description('Enter Details on Software License and Purchase Information')
                    ->collapsible()
                    ->compact()
                    ->columns(4)
                    ->schema([
                        TextInput::make('licensed_to_name'),
                        TextInput::make('licensed_to_email'),
                        TextInput::make('product_key'),
                        TextInput::make('order_number'),
                    ]),

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
                        DatePicker::make('expiration_date'),
                        DatePicker::make('termination_date'),
                    ]),

                ImagesAndNoteComponent::render(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('quantity')
                    ->searchable()
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalQuantityLeft()." out of $state")
                    ->sortable()
                    ->color(fn (Model $record): string => $record->totalQuantityLeft() <= 0 ? 'danger' : 'gray')
                    ->alignRight()
                    ->label('Quantity'),
                TextColumn::make('people_count')
                    ->counts('people')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['people'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('People'),
                TextColumn::make('hardware_count')
                    ->counts('hardware')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['hardware'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Hardware'),
                ...CreatedAtUpdatedAtComponent::render(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PeopleRelationManager::class,
            HardwareRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLicences::route('/'),
            'create' => Pages\CreateLicence::route('/create'),
            'edit' => Pages\EditLicence::route('/{record}/edit'),
        ];
    }
}
