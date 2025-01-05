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
        Schema::create('berkas_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_nibel')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->string('nomor_blanko_elektronik')->nullable();
            $table->string('posisi_berkas')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_keluar');
    }
};
