<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alternatif', function (Blueprint $table) {
            $table->id('id_alternatif');
            $table->integer('rencana_pelaksanaan_pembelajaran');
            $table->integer('kriteria_ketuntasan_minimal');
            $table->integer('pembuatan_soal');
            $table->integer('absensi_kehadiran');
            $table->integer('ketepatan_waktu');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('alternatif', function (Blueprint $table) {
            $table->unsignedBigInteger('id_akun')->nullable()->after('id_alternatif');
            $table->foreign('id_akun')->references('id_akun')->on('akun')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_guru')->nullable()->after('id_akun');
            $table->foreign('id_guru')->references('id_guru')->on('guru')->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::drop('alternatif');
    }
};
