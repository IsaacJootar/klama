<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fnb_kitchen_store_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->enum('action', ['add', 'deduct']);
            $table->decimal('quantity_changed', 10, 2);
            $table->decimal('quantity_before', 10, 2);
            $table->decimal('quantity_after', 10, 2);
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('fnb_kitchen_store_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fnb_kitchen_store_logs');
    }
};