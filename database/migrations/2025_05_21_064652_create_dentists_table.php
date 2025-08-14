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
        Schema::create('dentists', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->comment('The Dentist_id is a foreign key referncing User_id, ensuring that every dentist is also a registered user.');
            $table->string('specialty',20);
            $table->unsignedInteger('years_of_experience')->check('years_of_experience BETWEEN 0 AND 50');
            $table->timestamps();  
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->comment('This table inherits form users table. Each row represents a user with dentist-specific attributes.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentists');
    }
};
