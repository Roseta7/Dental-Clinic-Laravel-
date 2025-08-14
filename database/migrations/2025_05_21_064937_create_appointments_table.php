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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('dentist_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->decimal('appointment_cost',10,2);
            $table->enum('appointment_status',['completed','cancelled','rescheduled','upcoming','in-progress'])->default('upcoming');
            $table->enum('visit_type',['checkup','emergency','consultation','follow_up','treatment']);
            $table->timestamps();            
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('dentist_id')->references('id')->on('dentists')->onDelete('cascade');
            $table->comment('This table schedules the appointments and their details, where each record represents a scheduled appointment between patient and dentist.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
