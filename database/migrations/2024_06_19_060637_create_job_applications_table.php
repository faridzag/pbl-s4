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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('applicant_id', 16);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->enum('status', ['accept', 'reject', 'pending'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->constrained()->cascadeOnDelete()
            ->references('id')->on('users');
            $table->foreign('applicant_id')->constrained()->onDelete('cascade')
            ->references('id_number')->on('applicant_profiles');
            $table->foreign('company_id')->constrained()->onDelete('cascade')
            ->references('id')->on('company_profiles');
            $table->foreign('event_id')->constrained()->onDelete('cascade')
            ->references('id')->on('events');
            $table->foreign('vacancy_id')->constrained()->onDelete('cascade')
            ->references('id')->on('job_vacancies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
