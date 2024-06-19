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
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->string('id_number', 16)->primary();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->constrained()->cascadeOnDelete()
            ->references('id')->on('users');
            $table->string('phone_number', 11);
            $table->date('birth_date');
            $table->enum('gender',['pria', 'wanita']);
            $table->text('description')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};
