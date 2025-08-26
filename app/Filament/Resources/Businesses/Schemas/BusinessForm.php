<?php

namespace App\Filament\Resources\Businesses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BusinessForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->default(auth()->id()),
                TextInput::make('name')
                    ->required(),
                TextInput::make('legal_name'),
                TextInput::make('address_line_1'),
                TextInput::make('address_line_2'),
                TextInput::make('city'),
                TextInput::make('state'),
                TextInput::make('zip_code'),
                TextInput::make('country'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('website'),
                TextInput::make('tax_id'),
                TextInput::make('currency')
                    ->required()
                    ->default('MYR'),
                TextInput::make('logo_path'),
                Textarea::make('default_notes')
                    ->columnSpanFull(),
                Select::make('default_payment_term_id')
                    ->relationship('defaultPaymentTerm', 'name'),
            ]);
    }
}
