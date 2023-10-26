<?php

namespace App\Filament\Resources\Shared;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;

class NcqComponent
{
    public static function render()
    {
        return Grid::make()->schema([
            Section::make('Basic information')
                ->description('Provide details to facilitate accurate and effective tracking')
                ->collapsible()
                ->compact()
                ->columns(3)
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('quantity')
                        ->required()
                        ->minValue(0)
                        ->integer()
                        ->label('Quantity'),
                    TextInput::make('threshold')
                        ->label('Alert threshold')
                        ->required()
                        ->integer(),
                ])
                ->columnSpan(3),
            Section::make('QR Code')
                ->columnSpan(1)
                ->collapsible()
                ->compact()
                ->schema([ViewField::make('qr_code')->view('filament.components.qr_code')]),
        ])->columns(4);
    }
}
