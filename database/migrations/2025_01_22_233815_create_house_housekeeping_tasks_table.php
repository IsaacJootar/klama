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
        Schema::create('house_housekeeping_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id'); // References the rooms table
            $table->foreignId('staff_id'); // References housekeeping staff
            $table->text('task_description'); // Description of the task
            $table->enum('task_status', ['Pending', 'In Progress', 'Completed'])->default('Pending'); // Task status
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Low'); // Priority level
            $table->date('scheduled_date')->nullable(); // Task scheduled date
            $table->date('completed_date')->nullable(); // Task completed date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_housekeeping_tasks');
    }
};
