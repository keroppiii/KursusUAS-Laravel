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
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kursus_id');
        $table->unsignedBigInteger('peserta_id');
        $table->string('status');
        $table->timestamps();

        $table->foreign('kursus_id')->references('id')->on('kursuses')->onDelete('cascade');
        $table->foreign('peserta_id')->references('id')->on('pesertas')->onDelete('cascade');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
