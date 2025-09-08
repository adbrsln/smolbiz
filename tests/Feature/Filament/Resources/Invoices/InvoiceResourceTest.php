<?php

namespace Tests\Feature\Filament\Resources\Invoices;

use App\Filament\Resources\Invoices\Pages\CreateInvoice;
use App\Filament\Resources\Invoices\Pages\EditInvoice;
use App\Filament\Resources\Invoices\Pages\ListInvoices;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class InvoiceResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_index_page()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(ListInvoices::class)
            ->assertSuccessful();
    }

    public function test_renders_create_page()
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(CreateInvoice::class)
            ->assertSuccessful();
    }

    public function test_renders_edit_page()
    {
        $this->actingAs($user = User::factory()->create());
        $invoice = Invoice::factory()->create();

        Livewire::test(EditInvoice::class, ['record' => $invoice->getRouteKey()])
            ->assertSuccessful();
    }
}
