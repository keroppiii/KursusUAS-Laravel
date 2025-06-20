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
    Schema::create('kursuses', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kursus');
        $table->string('durasi');
        $table->unsignedBigInteger('instruktur_id');
        $table->integer('biaya');
        $table->timestamps();

        $table->foreign('instruktur_id')->references('id')->on('instrukturs')->onDelete('cascade');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kursuses');
    }
};
