<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Form;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class EditProfile extends BaseEditProfile
{
    public function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),

            Select::make('height_feet')
            ->label('Height (feet)')
            ->options([
                4 => '4 ft',
                5 => '5 ft',
                6 => '6 ft',
                7 => '7 ft',
            ])
            ->required()
            ->reactive(),

            TextInput::make('height_inches_extra')
                ->label('Inches')
                ->numeric()
                ->minValue(0)
                ->maxValue(11)
                ->required()
                ->reactive(),

            Toggle::make('digest_daily_enabled')
                ->label('Enable Daily Digest'),

            Toggle::make('digest_weekly_enabled')
                ->label('Enable Weekly Digest'),

            Toggle::make('digest_monthly_enabled')
                ->label('Enable Monthly Digest'),

            Toggle::make('digest_yearly_enabled')
                ->label('Enable Yearly Digest'),
        ]);
    }

    // add feet and inches to get total inches
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (
            isset($data['height_feet'], $data['height_inches_extra'])
        ) {
            $data['height_inches'] =
                ($data['height_feet'] * 12) + $data['height_inches_extra'];
        }

        unset($data['height_feet'], $data['height_inches_extra']);

        return $data;
    }

    // split total inches into feet and inches for form display
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (isset($data['height_inches'])) {
            $data['height_feet'] = intdiv($data['height_inches'], 12);
            $data['height_inches_extra'] = $data['height_inches'] % 12;
        }

        return $data;
    }
}
