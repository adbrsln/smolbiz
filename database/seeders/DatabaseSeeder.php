<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@email.com',
        ]);

        $user->businesses()->factory()->create([
            'name' => 'Demo Business',
            'slug' => 'demo-business',
            'type' => 'sole_trader',
            'status' => 'active',
        ])->customers()->factory()->create([
                    'phone' => '1234567890',
                    'address_line_1' => '123 Demo St',
                    'city' => 'Demo City',
                    'state' => 'Demo State',
                    'zip_code' => '12345',
                    'country' => 'Demo Country',
                ])->invoices()->factory()->create([
                    'invoice_number' => 'INV-001',
                    'issue_date' => now(),
                    'due_date' => now()->addDays(30),
                    'status' => 'draft',
                    'subtotal' => 100.00,
                    'tax_amount' => 10.00,
                    'total_amount' => 110.00,
                    'amount_paid' => 0.00,
                    'notes' => 'Demo Invoice',
                    'terms_and_conditions' => 'Demo Terms and Conditions',
                ]);
    }
}
