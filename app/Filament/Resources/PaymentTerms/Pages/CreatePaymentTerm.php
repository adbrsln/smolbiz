<?php

namespace App\Filament\Resources\PaymentTerms\Pages;

use App\Filament\Resources\PaymentTerms\PaymentTermResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePaymentTerm extends CreateRecord
{
    protected static string $resource = PaymentTermResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $business = Filament::getTenant();
        $data['business_id'] = $business->id;
        return static::getModel()::create($data);
    }
}
