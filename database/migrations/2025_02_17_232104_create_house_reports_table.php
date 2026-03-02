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
        Schema::create('house_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id'); // Unique report reference
            $table->integer('rooms_cleaned'); // Number of rooms cleaned
            $table->integer('laundry_items_processed'); // Number of laundry items handled
            $table->integer('maintenance_requests'); // Number of maintenance issues reported
            $table->integer('deep_cleaning_tasks'); // Number of deep cleaning tasks completed
            $table->integer('supplies_used'); // Number of cleaning supplies used
            $table->integer('amount'); // total money for scheduled maintenance tasks
            $table->text('notes'); // Additional comments or remarks
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
        Schema::dropIfExists('house_reports');
    }
};
