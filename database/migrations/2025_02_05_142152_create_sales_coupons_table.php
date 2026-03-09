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
        Schema::create('sales_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique(); // 6-digit uppercase alphanumeric code (e.g., A1B2C3)
            $table->decimal('discount_value', 10, 2); // Fixed discount amount (e.g., 25000.00)
            $table->date('start_date'); // Coupon validity start date
            $table->date('end_date'); // Coupon expiry date
            $table->integer('usage_count')->default(0); // Tracks usage (0 or 1 for single-use)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_coupons');
    }
};