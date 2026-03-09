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
        Schema::create('resv_room_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->string('category_id');
            $table->decimal('price',10,2)->default(0);
            $table->date('checkin')->default("1986-09-01");
            $table->date('checkout')->default("1986-09-01");
             $table->string('status')->default('Available'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resv_room_allocations');
    }
};
