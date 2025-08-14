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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name',50);
            $table->enum('patient_gender',['Male','Female'])->default('Male');
            $table->string('patient_phone',20)->unique();
            $table->string('patient_email',50)->unique();
            $table->date('date_of_birth');
            $table->timestamps();
            $table->comment('This table contain patients information added in clinic records.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
