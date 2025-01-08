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
        Schema::table('berkas_masuk', function (Blueprint $table) {
            $table->string('tahun')->after('nomor');
            $table->string('no_hp')->after('nama_pemohon');
            $table->date('jatuh_tempo')->after('layanan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas_masuk', function (Blueprint $table) {
            $table->dropColumn('tahun');
            $table->dropColumn('no_hp');
            $table->dropColumn('jatuh_tempo');
        });
    }
};
