<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFnbKitchenStoreItemsTable extends Migration
{
    public function up()
    {
        Schema::create('fnb_kitchen_store_items', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->string('measurement_tag');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('fnb_kitchen_store_categories')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fnb_kitchen_store_items');
    }
}
