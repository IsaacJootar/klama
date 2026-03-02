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
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id'); // Unique report reference
            $table->integer('total_sales'); // Total number of sales made
            $table->decimal('revenue_generated', 10, 2); // Total revenue generated
            $table->integer('new_clients'); // Number of new clients acquired
            $table->integer('follow_ups'); // Number of follow-up interactions
            $table->integer('deals_closed'); // Number of deals successfully closed
            $table->integer('refunds_processed'); // Number of refunds processed
            $table->integer('amount'); // total money for scheduled maintenance tasks
            $table->text('notes'); // Additional notes or comments
            $table->integer('sent_by');
            $table->integer('sent_to');
            $table->string('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_reports');
    }
};
