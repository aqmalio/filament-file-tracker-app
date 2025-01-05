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
        Schema::create('berkas_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('nama_pemohon');
            $table->unsignedBigInteger('notaris_id');
            $table->string('nomor_hak');
            $table->unsignedBigInteger('desa_id');
            $table->unsignedBigInteger('layanan_id');
            $table->tinyInteger('is_loket')->default(0);
            $table->timestamps();

            $table->foreign('notaris_id')->references('id')->on('notaris');
            $table->foreign('desa_id')->references('id')->on('desa');
            $table->foreign('layanan_id')->references('id')->on('layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_masuk');
    }
};
