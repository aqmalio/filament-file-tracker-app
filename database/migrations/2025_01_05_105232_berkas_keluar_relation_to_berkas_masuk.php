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
        Schema::table('berkas_keluar', function (Blueprint $table) {
            $table->unsignedBigInteger('berkas_masuk_id')->after('id');
            $table->foreign('berkas_masuk_id')->references('id')->on('berkas_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas_keluar', function (Blueprint $table) {
            //
        });
    }
};
