<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('consultation_code')->unique();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->date('visit_date');
            $table->string('attending_nurse')->nullable();
            $table->text('chief_complaint');
            $table->string('bp')->nullable();
            $table->string('temperature')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->text('diagnosis');
            $table->text('treatment')->nullable();
            $table->text('prescription')->nullable();
            $table->date('next_visit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
