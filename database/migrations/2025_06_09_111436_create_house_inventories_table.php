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
        Schema::create('house_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name'); // Item name
            $table->string('category_id'); // Item name
            $table->integer('quantity');
            $table->decimal('price')->nullable();
            //$table->integer('restock_threshold')->default(10); // Minimum stock
            $table->string('condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_inventories');
    }
};
