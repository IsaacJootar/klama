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
        Schema::create('house_cleaning_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id'); // References the rooms table
            $table->foreignId('user_id'); // References housekeeping staff
            $table->date('cleaning_date'); // Scheduled cleaning date
            $table->enum('shift', ['Morning', 'Afternoon', 'Evening']); // Shift
            $table->enum('status', ['Scheduled', 'Completed', 'Skipped'])->default('Scheduled'); // Cleaning status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_cleaning_schedules');
    }
};
