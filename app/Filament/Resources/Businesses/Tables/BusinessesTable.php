<?php

namespace App\Filament\Resources\Businesses\Tables;

use App\Models\Business;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BusinessesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('legal_name')
                    ->searchable(),
                TextColumn::make('city')
                    ->searchable(),
                TextColumn::make('state')
                    ->searchable(),
                TextColumn::make('country')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('manage')
                ->label('Manage')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(
                    // This closure generates the URL for each row
                    fn (Business $record): string => Filament::getPanel('business')->getUrl($record)
                ),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
