<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Str;
use App\Models\ProductService;
use Filament\Facades\Filament;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class InvoiceForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(1)
                    ->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'display_name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),
                Grid::make(3)
                    ->schema([
                        TextInput::make('invoice_number')
                            ->default('INV-' . random_int(1000, 9999))
                            ->required(),
                        DatePicker::make('issue_date')
                            ->default(now())
                            ->required(),
                        DatePicker::make('due_date')
                            ->default(now()->addDays(30))
                            ->required(),
                    ]),

                Section::make('Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_service_id')
                                    ->label('Item')
                                    ->options(ProductService::query()->pluck('name', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function ($state,Set $set) {
                                        $product = ProductService::find($state);
                                        if ($product) {
                                            $set('description', $product->description);
                                            $set('unit_price', $product->unit_price);
                                            $set('taxable', $product->taxable);
                                        }

                                    })
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(2),
                                Textarea::make('description')
                                    ->columnSpan(2),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->live()
                                    ->required(),
                                TextInput::make('unit_price')
                                    ->numeric()
                                    ->prefix('MYR') // Change currency as needed
                                    ->live()
                                    ->required(),
                                TextInput::make('tax_rate')
                                    ->label('Tax Rate (%)')
                                    ->numeric()
                                    ->default(0)
                                    ->live()
                                    ->suffix('%'),
                            ])
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                // This is the main calculation function
                                self::updateTotals($get, $set);
                            })
                            ->live()
                            ->columns(6)
                            ->addActionLabel('Add Item')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['description'] ?? null),
                    ])->columnSpanFull(),

                Grid::make(3)
                    ->schema([
                        TextInput::make('subtotal')
                            ->numeric()
                            ->prefix('MYR')
                            ->readOnly(),
                        TextInput::make('tax_amount')
                            ->numeric()
                            ->prefix('MYR')
                            ->readOnly(),
                        TextInput::make('total_amount')
                            ->numeric()
                            ->prefix('MYR')
                            ->readOnly(),
                    ]),

                Textarea::make('notes')
                    ->columnSpanFull(),
                Textarea::make('terms_and_conditions')
                    ->columnSpanFull(),
            ]);
    }

    public static function updateTotals(Get $get, Set $set): void
    {
        $items = $get('items');
        $subtotal = 0;
        $totalTax = 0;

        if (is_array($items)) {
            foreach ($items as $item) {
                $quantity = (float)($item['quantity'] ?? 0);
                $unitPrice = (float)($item['unit_price'] ?? 0);
                $taxRate = (float)($item['tax_rate'] ?? 0);

                $itemSubtotal = $quantity * $unitPrice;
                $itemTax = $itemSubtotal * ($taxRate / 100);

                $subtotal += $itemSubtotal;
                $totalTax += $itemTax;
            }
        }

        $set('subtotal', number_format($subtotal, 2, '.', ''));
        $set('tax_amount', number_format($totalTax, 2, '.', ''));
        $set('total_amount', number_format($subtotal + $totalTax, 2, '.', ''));
    }


}
