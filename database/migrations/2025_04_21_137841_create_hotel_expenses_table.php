<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount',10,2)->default(0);
            $table->text('note')->nullable();
            $table->string('section')->nullable();
            $table->string('expense_date');
            $table->string('expense_title');
            $table->string('expense_code', 20); // random alphanumeri
            $table->boolean('list_flag')->default(0);     // 0 or 1- this is for knowing a list is completed or not
            $table->timestamps();

            // Optional: Add foreign key constraints if related tables exist
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('item_id')->references('id')->on('items');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_expenses');
    }
};
