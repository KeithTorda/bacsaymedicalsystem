<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appointment_code')->unique();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('date');
            $table->string('time')->nullable();
            $table->string('purpose')->nullable();
            $table->string('status')->default('Scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
