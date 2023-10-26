<?php

namespace App\Filament\Resources\Shared;

use Filament\Tables\Columns\TextColumn;

class CreatedAtUpdatedAtComponent
{
    public static function render()
    {
        return [
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->alignRight()
                ->toggleable(),
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->alignRight()
                ->toggleable(),
        ];
    }
}
