<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Form;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

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
}
