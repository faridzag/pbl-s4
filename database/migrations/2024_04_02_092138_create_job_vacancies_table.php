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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('event_id');
            $table->string('position', 100);
            $table->string('description', 1500);
            $table->enum('status', ['open', 'closed']);
            $table->foreign('user_id')->constrained()->cascadeOnDelete()
            ->references('id')->on('users');
            $table->foreign('company_id')->constrained()->cascadeOnDelete()
            ->references('id')->on('company_profiles');
            $table->foreign('event_id')->constrained()->cascadeOnDelete()
            ->references('id')->on('events');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
