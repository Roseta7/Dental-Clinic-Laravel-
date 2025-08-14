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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id()->comment('Unique ID for each audit log entry');;
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID of the user who performed the action (foreign key to Users table)');
            $table->enum('action_type',['Update','Delete'])->comment('The type of action performed: DELETE or UPDATE');
            $table->string('table_name',100)->comment('the name of the table where the change occurred');
            $table->unsignedBigInteger('record_id')->comment('The ID of the affected record in the original table');
            $table->text('action_details')->comment('The details of action performed e.g deleted patient name');
            $table->timestamp('action_time')->useCurrent()->comment('The time when the change occured');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->comment('This table logs DELETE and UPDATE operations on key tables such as Patients, MedicalHistories, Invoices and Treatments, for security auditing and historical tracking purposes.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
