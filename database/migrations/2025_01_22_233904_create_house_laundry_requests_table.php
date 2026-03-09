<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('house_laundry_requests', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->unsignedBigInteger('room_id');
            $table->text('items');
            $table->decimal('total_cost', 10, 2);
            $table->enum('status', ['Received', 'Delivered'])->default('Received');
            $table->datetime('requested_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('notes')->nullable();
            $table->decimal('amount_received', 10, 2)->nullable();
            $table->enum('payment_status', ['Paid'])->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('resv_rooms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('house_laundry_requests');
    }
};