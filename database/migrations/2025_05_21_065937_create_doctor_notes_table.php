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
        Schema::create('doctor_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id');
            $table->string('noteDescription',300);
            $table->timestamp('dateCreated')->useCurrent();
            $table->timestamps();
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
            $table->comment('This table contains doctor\'s notes regarding patient\'s treatment, appointment, and status. Automatically timestamps each notes.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_notes');
    }
};
