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
        Schema::create('payment_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., "Net 30", "Due on receipt"
            $table->integer('days'); // e.g., 30, 0
            $table->timestamps();
        });

        // Now add the foreign key to the businesses table
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreignId('default_payment_term_id')
                  ->nullable()
                  ->constrained('payment_terms')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('default_payment_term_id');
        });
        Schema::dropIfExists('payment_terms');
    }
};
