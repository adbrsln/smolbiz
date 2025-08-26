<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Invoice;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BusinessStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $tenant = Filament::getTenant();
        $currency = $tenant->currency ?? 'USD'; // Default to USD if not set

        // Calculate the total of unpaid invoices
        $totalUnpaid = Invoice::whereNotIn('status', ['paid', 'cancelled'])->sum('total_amount');

        return [
            Stat::make('Total Customers', Customer::count())
                ->description('All customers in this business')
                ->icon('heroicon-o-users'),

            Stat::make('Total Invoices', Invoice::count())
                ->description('All invoices created')
                ->icon('heroicon-o-document-text'),

            Stat::make('Total Unpaid', number_format($totalUnpaid, 2) . ' ' . $currency)
                ->description('Sum of sent & overdue invoices')
                ->color('warning')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
