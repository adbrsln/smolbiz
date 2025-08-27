<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;

    public static function mutateFormDataBeforeSave(array $data): array
    {
        foreach ($data['items'] as $item) {
            $quantity = (float)($item['quantity'] ?? 0);
            $unitPrice = (float)($item['unit_price'] ?? 0);
            $taxRate = (float)($item['tax_rate'] ?? 0);

            $itemSubtotal = $quantity * $unitPrice;
            $itemTax = $itemSubtotal * ($taxRate / 100);

            $item['subtotal'] = $itemSubtotal;
            $item['tax_amount'] = $itemTax;
            $item['total_amount'] = $itemTax + $itemSubtotal;
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $business = Filament::getTenant();
        $data['business_id'] = $business->id;
        return static::getModel()::create($data);
    }


}
