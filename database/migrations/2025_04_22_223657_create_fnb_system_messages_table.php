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
        Schema::create('fnb_system_messages', function (Blueprint $table) {
             $table->id();
            $table->integer('message_id');
            $table->text('message');
            $table->string('message_type');
            $table->integer('sent_by');
            $table->integer('sent_to');
            $table->string('section');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fnb_system_messages');
    }
};
