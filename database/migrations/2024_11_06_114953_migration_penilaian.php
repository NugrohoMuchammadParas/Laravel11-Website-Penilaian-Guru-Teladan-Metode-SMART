<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->integer('id_guru');
            $table->float('rencana_pelaksanaan_pembelajaran');
            $table->float('kriteria_ketuntasan_minimal');
            $table->float('pembuatan_soal');
            $table->float('absensi_kehadiran');
            $table->float('ketepatan_waktu');
            $table->float('nilai');
            $table->integer('rank');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('penilaian', function (Blueprint $table) {
            $table->unsignedBigInteger('id_alternatif')->nullable()->after('id_penilaian');

            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::drop('penilaian');
    }
};
