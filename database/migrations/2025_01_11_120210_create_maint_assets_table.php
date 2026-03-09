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
        Schema::create('maint_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->string('name'); // Asset name
            $table->string('location'); // Location of the asset (Room 101, Lobby, etc.)
            $table->date('purchase_date')->nullable();
            $table->date('last_maintenance_date')->nullable();
            $table->enum('status', ['Operational', 'Under Maintenance', 'Decommissioned'])->default('Operational');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maint_assets');
    }
};
