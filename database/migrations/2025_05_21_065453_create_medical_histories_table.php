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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id');
            $table->string('procedure_Summary',300);
            $table->text('diagnosis')->nullable();
            $table->text('previous_Treatments')->nullable();
            $table->date('medical_treat_date');
            $table->string('medications',300)->nullable();
            $table->timestamps();
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
            $table->comment('keeps track of patient\'s Medical History, including diagnoses, previous treatments, related treatment sessions, and medications.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
