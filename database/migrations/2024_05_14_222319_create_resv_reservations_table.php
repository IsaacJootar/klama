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
        Schema::create('resv_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('room_id');
            $table->foreignId('category_id');
            $table->integer('reservation_id');
            $table->integer('nor');
            $table->string('medium');
            $table->string('payment_status')->default('Pending');
            $table->string('fullname');
            $table->text('address')->nullable();
            $table->string('requests')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('checkin');
            $table->string('checkout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resv_reservations');
    }
};
