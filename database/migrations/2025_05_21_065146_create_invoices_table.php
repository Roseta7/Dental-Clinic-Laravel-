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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->decimal('totalbill',10,2);
            $table->timestamp('paymentDate')->useCurrent();
            $table->enum('paymentMethode',['CreditCard','PayPal','Cash'])->nullable();
            $table->enum('paymentStatus',['Paid','Unpaid'])->default('Unpaid');
            $table->timestamps();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->comment('This table stores invoice information for each appointment.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
