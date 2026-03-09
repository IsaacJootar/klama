<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_income', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount',10,2)->default(0);
            $table->text('note')->nullable();
            $table->string('section')->nullable();
            $table->string('income_date');
            $table->string('income_title');
            $table->string('income_code', 20); 
            $table->timestamps();

           
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_income');
    }
};
