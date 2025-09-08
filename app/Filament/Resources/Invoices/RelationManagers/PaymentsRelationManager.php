<?php

namespace App\Filament\Resources\Invoices\RelationManagers;

use App\Filament\Resources\Invoices\Schemas\InvoicePaymentForm;
use App\Filament\Resources\Invoices\Tables\InvoicePaymentTable;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;


class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Schema $schema): Schema
    {
        return InvoicePaymentForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return InvoicePaymentTable::configure($table);
    }


    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateDataUsing(function (array $data): array {
                $data['invoice_id'] = $this->getOwnerRecord()->id;
                return $data;
            })
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            DeleteBulkAction::make(),
        ];
    }

}
