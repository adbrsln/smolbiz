<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('business_id')->constrained()->onDelete('cascade'); // Redundant but good for quick filtering payments per business
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method'); // e.g., 'bank_transfer', 'credit_card', 'cash', 'cheque'
            $table->string('transaction_id')->nullable(); // From payment gateway
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
