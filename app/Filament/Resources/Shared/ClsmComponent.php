<?php

namespace App\Filament\Resources\Shared;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class ClsmComponent
{
    public static function render($withManufacturer = true)
    {
        $schema = [
            BelongsToSelect::make('department_id')
                ->relationship('department', 'name')
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
                ->preload(),
            BelongsToSelect::make('location_id')
                ->relationship('location', 'name')
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
                ->preload(),
            BelongsToSelect::make('supplier_id')
                ->relationship('supplier', 'name')
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
                ->preload(),
        ];

        if ($withManufacturer) {
            $schema[] = BelongsToSelect::make('manufacturer_id')
                ->relationship('manufacturer', 'name')
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
                ->preload();
        }

        return Section::make('Asset detail submission')
            ->description('Provide detailed information about your asset')
            ->collapsible()
            ->compact()
            ->columns($withManufacturer ? 4 : 3)
            ->schema($schema);
    }
}
