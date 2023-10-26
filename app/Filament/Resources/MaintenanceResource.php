<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Filament\Resources\Shared\CreatedAtUpdatedAtComponent;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Models\Maintenance;
use App\Traits\HasCustomFields;
use Filament\Facades\Filament;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
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

class MaintenanceResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static ?string $navigationGroup = 'Intangible Assets';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make('Basic information')
                        ->collapsible()
                        ->compact()
                        ->columns(3)
                        ->columnSpan(4)
                        ->schema([
                            BelongsToSelect::make('hardware_id')
                                ->relationship('hardware', 'name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            TextInput::make('maintenance_type')
                                ->label('Maintenance Type'),
                            DatePicker::make('maintenance_date')
                                ->label('Maintenance Date'),
                            TextInput::make('performed_by')
                                ->label('Performed By'),
                            TextInput::make('cost')
                                ->label('Cost')
                                ->numeric()
                                ->minValue(0.0)
                                ->prefix(Filament::getTenant()->currency),
                        ]),
                    Section::make('QR Code')
                        ->columnSpan(2)
                        ->collapsible()
                        ->compact()
                        ->schema([ViewField::make('qr_code')->view('filament.components.qr_code')]),
                ])->columns(6),
                self::customFieldsSchema(self::getModel()),
                ImagesAndNoteComponent::render(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('hardware.hardware_model.name')->sortable()->searchable(),
                TextColumn::make('maintenance_type')->sortable()->searchable()->badge(),
                TextColumn::make('performed_by')->sortable()->searchable(),
                TextColumn::make('maintenance_date')->sortable()->date()->alignRight(),

                ...CreatedAtUpdatedAtComponent::render(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data) {
                        return static::handleRecordUpdateStatic($record, $data);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMaintenances::route('/'),
        ];
    }
}
