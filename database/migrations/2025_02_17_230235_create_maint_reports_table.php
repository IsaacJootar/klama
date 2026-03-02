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
        Schema::create('maint_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('report_id'); // Reference to a specific report
            $table->integer('equipment_checked'); // Number of equipment checked
            $table->integer('repairs_done'); // Number of repairs completed
            $table->integer('faults_reported'); // Number of faults/issues reported
            $table->integer('emergency_repairs'); // Number of emergency repairs
            $table->integer('scheduled_maintenance'); // Number of scheduled maintenance tasks
            $table->integer('amount'); // total money for scheduled maintenance tasks
            $table->text('notes'); // Additional notes or comments
            $table->integer('sent_by');
            $table->integer('sent_to');
            $table->string('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maint_reports');
    }
};
