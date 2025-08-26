<?php

namespace App\Filament\Resources\ProductServices\Pages;

use App\Filament\Resources\ProductServices\ProductServiceResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProductService extends CreateRecord
{
    protected static string $resource = ProductServiceResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $business = Filament::getTenant();
        $data['business_id'] = $business->id;
        return static::getModel()::create($data);
    }
}
