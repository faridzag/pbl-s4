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
        Schema::create('event_company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamps();
            $table->foreign('event_id')->constrained()->onDelete('cascade')
            ->references('id')->on('events');
            $table->foreign('company_id')->constrained()->onDelete('cascade')
            ->references('id')->on('company_profiles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_company');
    }
};
