<?php

namespace App\Filament\Resources\Businesses\Pages;

use App\Filament\Resources\Businesses\BusinessResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Facades\Filament;

class CreateBusiness extends CreateRecord
{
    protected static string $resource = BusinessResource::class;

    protected function getRedirectUrl(): string
    {
        $tenant = $this->getRecord();
        $adminPanel = Filament::getPanel('admin'); // <-- Get the 'admin' panel

        // Generate a URL to the tenant dashboard within the 'admin' panel
        return $adminPanel->getUrl($tenant);
    }
}
