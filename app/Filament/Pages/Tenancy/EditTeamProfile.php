<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Settings';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Team settings')
                    ->collapsible()
                    ->compact()
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('currency')
                            ->options([
                                'USD' => 'USD',
                                'EUR' => 'EUR',
                            ])
                            ->required(),
                    ]),

                Section::make('Notification settings')
                    ->collapsible()
                    ->compact()
                    ->columns(3)
                    ->schema([
                        TextInput::make('discordWebhookUrl')
                            ->label('Discord')
                            ->helperText('Enter your Discord webhook URL to receive notifications in case of an alert.'),

                        TextInput::make('slackWebhookUrl')
                            ->label('Slack')
                            ->helperText('Enter your Slack webhook URL to receive notifications in case of an alert.'),
                    ]),
            ]);
    }
}
