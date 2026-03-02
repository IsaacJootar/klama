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
            $table->decimal('unit_price',10,2)->default(0);
            $table->decimal('total_amount',10,2)->default(0);
            $table->string('coupon_code', 6)->nullable()->default(0);
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
            $table->string('status');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->enum('checkin_status', ['Pending', 'Checkedin', 'Checkedout']);
            $table->string('checkin_type')->nullable()->default('Standard');
            $table->decimal('early_checkin_fee', 10, 2)->nullable()->default(0.00);
            $table->enum('checkout_status', ['Pending', 'Checkedout'])->default('Pending');
            $table->string('checkout_type')->nullable()->default('Standard');
            $table->decimal('late_checkout_fee', 10, 2)->nullable()->default(0.00);
            $table->text('confirmation_note')->nullable();
            $table->string('state')->default('Default');
            $table->string('flag')->default('Active');
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
