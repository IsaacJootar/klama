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
        Schema::create('house_room_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id'); // References the rooms table
            $table->enum('status', ['Clean', 'Dirty', 'Under Maintenance'])->default('Dirty'); // Room status
            $table->timestamp('last_cleaned_at')->nullable(); // Timestamp of the last cleaning
            $table->date('next_cleaning_due')->nullable(); // Next cleaning due date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_room_statuses');
    }
};
