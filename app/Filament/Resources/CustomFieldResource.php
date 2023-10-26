<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomFieldResource\Pages;
use App\Filament\Resources\Shared\CreatedAtUpdatedAtComponent;
use App\Models\CustomField;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomFieldResource extends Resource
{
    protected static ?string $model = CustomField::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

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
                        ->description('Provide details to facilitate accurate and effective tracking')
                        ->collapsible()
                        ->compact()
                        ->columns(3)
                        ->columnSpan(3)
                        ->schema([
                            TextInput::make('name')->required(),
                            Select::make('field_type')
                                ->options([
                                    'text' => 'Text',
                                    'number' => 'Number',
                                    'date' => 'Date',
                                ])
                                ->default('text')
                                ->required(),
                            Select::make('applicable_model')
                                ->options([
                                    'App\Models\Hardware' => 'Hardware',
                                    'App\Models\Component' => 'Component',
                                    'App\Models\Consumable' => 'Consumable',
                                    'App\Models\Department' => 'Department',
                                    'App\Models\Depreciation' => 'Depreciation',
                                    'App\Models\Licence' => 'License',
                                    'App\Models\Location' => 'Location',
                                    'App\Models\Maintenance' => 'Maintenance',
                                    'App\Models\Manufacturer' => 'Manufacturer',
                                    'App\Models\Person' => 'Person',
                                    'App\Models\Supplier' => 'Supplier',
                                ])
                                ->required(),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('field_type')->searchable()->sortable()->badge(),
                TextColumn::make('applicable_model')
                    ->searchable()
                    ->formatStateUsing(function (string $state): string {
                        return class_basename($state);
                    })
                    ->sortable()
                    ->badge(),
                ...CreatedAtUpdatedAtComponent::render(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomFields::route('/'),
        ];
    }
}
