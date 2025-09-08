<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\PaymentTerm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'customer_id' => Customer::factory(),
            'payment_term_id' => PaymentTerm::factory(),
            'invoice_number' => $this->faker->unique()->numerify('INV-####'),
            'issue_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['draft', 'sent', 'paid']), 
            'subtotal' => $this->faker->randomFloat(2, 100, 1000),
            'tax_amount' => $this->faker->randomFloat(2, 10, 100),
            'total_amount' => $this->faker->randomFloat(2, 110, 1100),
            'amount_paid' => $this->faker->randomFloat(2, 0, 1100),
            'notes' => $this->faker->text(),
            'terms_and_conditions' => $this->faker->text(),
        ];
    }
}