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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->date('treatment_date');
            $table->enum('treatment_type',['Restorative','Endodontics','Periodontics','Oral_Surgery','Orthodontics']);
            $table->string('treatment_procedure',300);
            $table->decimal('treatment_cost',10,2);
            $table->enum('treatment_status',['pending','in_progress','completed','cancelled','postponed']);
            $table->timestamps();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->comment('This table stores details of treatments performed for each patient at each appointment.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
