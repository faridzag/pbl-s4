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
        Schema::create('job_application_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacancy_id');
            $table->string('accept_message', 1500);
            $table->string('reject_message', 1500)->default('Terima kasih telah melamar, namun kami belum dapat menerima Anda saat ini.');
            $table->foreign('vacancy_id')->constrained()->onDelete('cascade')
            ->references('id')->on('job_vacancies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application_messages');
    }
};
