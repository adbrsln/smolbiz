<?php

namespace App\Filament\Resources\ProductServices\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('unit_price')
                    ->required()
                    ->numeric(),
                Toggle::make('is_service')
                    ->required(),
                Toggle::make('taxable')
                    ->required(),
            ]);
    }
}
