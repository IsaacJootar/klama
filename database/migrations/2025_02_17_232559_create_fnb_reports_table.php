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
        Schema::create('fnb_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id'); // Unique report reference
            $table->integer('total_orders'); // Total number of orders served
            $table->decimal('total_revenue', 10, 2); // Total revenue generated from sales
            $table->integer('wastage'); // Amount of food/beverage wasted (in units)
            $table->integer('complaints_received'); // Number of customer complaints
            $table->integer('special_requests'); // Number of special meal requests
            $table->integer('inventory_used'); // Number of ingredients/items used
            $table->integer('inventory_remaining'); // Remaining stock count
            $table->integer('user_id'); // Number of staff on duty
            $table->integer('amount'); // total money for scheduled maintenance tasks
            $table->text('notes'); // Additional notes or comments
            $table->integer('sent_by');
            $table->integer('sent_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fnb_reports');
    }
};
