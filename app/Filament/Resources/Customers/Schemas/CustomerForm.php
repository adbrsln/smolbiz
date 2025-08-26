<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('display_name')
                    ->required(),
                TextInput::make('contact_name'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('billing_address_line_1'),
                TextInput::make('billing_address_line_2'),
                TextInput::make('billing_city'),
                TextInput::make('billing_state'),
                TextInput::make('billing_zip_code'),
                TextInput::make('billing_country'),
                TextInput::make('shipping_address_line_1'),
                TextInput::make('shipping_address_line_2'),
                TextInput::make('shipping_city'),
                TextInput::make('shipping_state'),
                TextInput::make('shipping_zip_code'),
                TextInput::make('shipping_country'),
                TextInput::make('tax_id'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
