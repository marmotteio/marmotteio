<?php

namespace App\Filament\Resources\Shared;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;

class ImagesAndNoteComponent
{
    public static function render()
    {
        return Section::make('Notes')
            ->description('Jot down any important details')
            ->schema([
                Textarea::make('notes'),
            ])
            ->collapsible()
            ->compact();
    }
}
