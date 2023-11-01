<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepreciationResource\Pages;
use App\Filament\Resources\Shared\ImagesAndNoteComponent;
use App\Models\Depreciation;
use App\Traits\HasCustomFields;
use Filament\Facades\Filament;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class DepreciationResource extends Resource
{
    use HasCustomFields;

    protected static ?string $model = Depreciation::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-down';

    protected static ?string $navigationGroup = 'Intangible Assets';

    protected static ?int $navigationSort = 103;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make('Purchase date & cost')
                        ->description('Please fill in the following form')
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
                            Select::make('method')
                                ->label('Depreciation Method')
                                ->options([
                                    'straight_line' => 'Straight-Line',
                                    'double_declining' => 'Double Declining Balance',
                                ])
                                ->required(),
                            DatePicker::make('purchase_date')
                                ->label('Purchase Date')
                                ->required(),
                            TextInput::make('purchase_price')
                                ->label('Purchase Price')
                                ->type('number')
                                ->required()
                                ->prefix(Filament::getTenant()->currency),
                            TextInput::make('residual_value')
                                ->label('Residual Value')
                                ->type('number')
                                ->required()
                                ->prefix(Filament::getTenant()->currency),
                            TextInput::make('useful_life_years')
                                ->label('Useful Life (Years)')
                                ->type('number')
                                ->required(),
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
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hardware.hardware_model.name')
                    ->label('Hardware')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purchase_date')
                    ->sortable()
                    ->date(),
                Tables\Columns\TextColumn::make('purchase_price')
                    ->money(Filament::getTenant()->currency)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('depreciation_expense')
                    ->money(Filament::getTenant()->currency)
                    ->alignRight()
                    ->toggleable()
                    ->searchable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('accumulated_depreciation')
                    ->money(Filament::getTenant()->currency)
                    ->alignRight()
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_book_value')
                    ->money(Filament::getTenant()->currency)
                    ->alignRight()
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data) {
                        return static::handleRecordUpdateStatic($record, $data);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDepreciations::route('/'),
        ];
    }
}
