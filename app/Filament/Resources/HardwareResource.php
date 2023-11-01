<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HardwareResource\Pages;
use App\Filament\Resources\HardwareResource\RelationManagers\ComponentsRelationManager;
use App\Filament\Resources\HardwareResource\RelationManagers\LicencesRelationManager;
use App\Filament\Resources\HardwareResource\RelationManagers\PeopleRelationManager;
use App\Filament\Resources\Shared\ClsmComponent;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Models\Hardware;
use App\Traits\HasCustomFields;
use Filament\Facades\Filament;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class HardwareResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Hardware::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationGroup = 'Physical Assets';

    protected static ?int $navigationSort = 0;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->hardware_model?->name;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['id', 'qr_code', 'hardware_model.name', 'serial_number', 'purchase_cost', 'order_number', 'notes'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Serial number' => $record->serial_number,
            'Status' => $record->hardware_status?->name,
            'Department' => $record->department?->name ?? 'Unknown',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make('Basic information')
                        ->description('Provide details to facilitate accurate and effective tracking')
                        ->schema([
                            BelongsToSelect::make('hardware_model_id')
                                ->relationship('hardware_model', 'name')
                                ->searchable()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->editOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->preload()
                                ->columnSpan(2)
                                ->required(),
                            BelongsToSelect::make('hardware_status_id')
                                ->relationship('hardware_status', 'name')
                                ->columnSpan(2)
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->editOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                ])
                                ->searchable()
                                ->preload()
                                ->required(),
                            TextInput::make('serial_number')
                                ->columnSpan(2),
                        ])
                        ->collapsible()
                        ->compact()
                        ->columns(6)
                        ->columnSpan(3),
                    Section::make('QR Code')
                        ->columnSpan(1)
                        ->collapsible()
                        ->compact()
                        ->schema([ViewField::make('qr_code')->view('filament.components.qr_code')]),
                ])->columns(4),

                self::customFieldsSchema(self::getModel()),

                ClsmComponent::render(false),

                Section::make('Purchase date & cost')
                    ->description('Please fill in the following form')
                    ->schema([
                        DatePicker::make('purchase_date'),
                        TextInput::make('purchase_cost')
                            ->numeric()
                            ->prefix(Filament::getTenant()->currency),
                        TextInput::make('order_number'),
                        DatePicker::make('end_of_life_date'),
                    ])
                    ->collapsible()
                    ->compact()
                    ->columns(4),

                Section::make('Requestability')
                    ->description('Can this asset be requested by others?')
                    ->schema([
                        Toggle::make('requestable'),
                        // Toggle::make('notify_me')
                        //     ->helperText('Get notified when status changes.'),
                    ])
                    ->collapsible()
                    ->compact()
                    ->columns(),

                ImagesAndNoteComponent::render(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('hardware_model.name')
                    ->sortable()
                    ->searchable()
                    ->iconPosition('after'),
                TextColumn::make('hardware_status.name')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color('success')
                    ->iconPosition('after'),
                TextColumn::make('serial_number')->sortable()->alignRight()->searchable()->badge(),
                TextColumn::make('people_count')
                    ->counts('people')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['people'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('People'),
                TextColumn::make('components_count')
                    ->counts('components')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['components'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Components'),
                TextColumn::make('licences_count')
                    ->counts('licences')
                    ->formatStateUsing(fn (string $state, Model $record): string => $record->totalNotCheckedInFor(['licences'])." out of $state")
                    ->sortable()
                    ->color('gray')
                    ->alignRight()
                    ->label('Licences'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //FilamentExportHeaderAction::make('export'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LicencesRelationManager::class,
            ComponentsRelationManager::class,
            PeopleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHardware::route('/'),
            'create' => Pages\CreateHardware::route('/create'),
            'edit' => Pages\EditHardware::route('/{record}/edit'),
        ];
    }
}
