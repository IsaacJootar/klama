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
        Schema::create('maint_request', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // title of the request
            $table->text('description'); // Request description
            $table->enum('status', ['Open', 'In Progress', 'Resolved', 'Closed'])->default('Open');
            $table->enum('priority', ['Low', 'Medium', 'High'])->default('Low');
            $table->foreignId('department_id'); // requesting department
            $table->foreignId('assigned_to'); // technician
            $table->foreignId('asset_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maint_request');
    }
};
