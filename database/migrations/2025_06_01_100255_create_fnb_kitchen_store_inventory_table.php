<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fnb_kitchen_store_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('kitchen_store_items')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->timestamp('last_updated')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fnb_kitchen_store_inventory');
    }
};