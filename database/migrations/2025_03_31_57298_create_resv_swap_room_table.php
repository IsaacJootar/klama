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
        Schema::create('resv_swap_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('swap_from_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('swap_to_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('from_category_id')->constrained('resv_room_categories')->onDelete('cascade');
            $table->foreignId('to_category_id')->constrained('resv_room_categories')->onDelete('cascade');
            $table->foreignId('from_reservation_id')->constrained('reservations')->onDelete('cascade');
           $table->foreignId('to_reservation_id')->nullable()->constrained('reservations')->nullOnDelete();
            $table->string('customer')->nullable();
            $table->string('to_customer')->nullable();
            $table->string('to_phone')->nullable();
            $table->string('to_email')->nullable();
            $table->string('swap_type');
            $table->string('swap_value');
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
