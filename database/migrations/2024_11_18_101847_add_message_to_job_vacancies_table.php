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
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->string('accept_message', 1500)->after('description');
            $table->string('reject_message', 1500)->default('Terima kasih telah melamar, namun kami belum dapat menerima Anda saat ini.')->after('accept_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            //
            $table->dropColumn('website');
        });
    }
};
