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
        Schema::create('resv_room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->text('details');
            $table->string('wifi')->nullable();
            $table->string('lunch')->nullable();
            $table->string('laundry')->nullable();
            $table->string('breakfast')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resv_room_categories');
    }
};
