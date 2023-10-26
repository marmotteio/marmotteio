<?php

namespace App\Filament\Resources\Shared;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;

class FilesAndNoteComponent
{
    public static function render()
    {
        return Section::make('Files & Notes Submission')
            ->description('Attach files and jot down any important details')
            ->schema([
                // FileUpload::make('files')->multiple(),
                SpatieMediaLibraryFileUpload::make('files')
                    ->imagePreviewHeight('250')
                    ->multiple()
                    ->enableReordering()
                    ->responsiveImages()
                    ->conversion('thumb'),
                Textarea::make('notes'),
            ])
            ->collapsible()
            ->compact()
            ->columns(2);
    }
}
