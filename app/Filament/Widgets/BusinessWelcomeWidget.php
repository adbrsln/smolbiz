<?php

namespace App\Filament\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class BusinessWelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.business-welcome-widget';

    // Make the widget take up the full width of the column
    protected int | string | array $columnSpan = 'full';

    public function getTenant(): Model
    {
        return Filament::getTenant();
    }

    public function getUser(): Authenticatable
    {
        return Filament::auth()->user();
    }
}
