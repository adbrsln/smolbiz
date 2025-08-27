<?php

namespace App\Filament\Resources\Businesses\Pages;

use App\Filament\Resources\Businesses\BusinessResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;

class CreateBusiness extends CreateRecord
{
    protected static string $resource = BusinessResource::class;

    protected function getRedirectUrl(): string
    {
        $tenant = $this->getRecord();
        $adminPanel = Filament::getPanel('tenant'); // <-- Get the 'admin' panel

        // Generate a URL to the tenant dashboard within the 'admin' panel
        return $adminPanel->getUrl($tenant);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = auth()->id();
        return static::getModel()::create($data);
    }
}
