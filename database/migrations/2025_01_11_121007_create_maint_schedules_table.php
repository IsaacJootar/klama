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
        Schema::create('maint_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('task_name'); // Scheduled task name
            $table->foreignId('asset_id'); // Related asset
            $table->enum('frequency', ['Daily', 'Weekly', 'Monthly', 'Quarterly', 'Yearly']);
            $table->date('next_scheduled_date');
            $table->foreignId('assigned_to'); // technician
            $table->enum('status', ['Scheduled', 'In Progress', 'Completed'])->default('Scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maint_schedules');
    }
};
