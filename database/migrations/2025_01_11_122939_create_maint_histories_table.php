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
        Schema::create('maint_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id'); // Related request
            $table->foreignId('asset_id'); // Related asset
            $table->foreignId('assigned_to'); // Technician
            $table->text('task_description');
            $table->date('date_completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maint_histories');
    }
};
