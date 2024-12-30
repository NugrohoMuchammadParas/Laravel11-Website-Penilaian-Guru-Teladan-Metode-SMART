<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModelAlternatifFactory extends Factory
{
    private static $idKaryawanCounter = 1;

    public function definition(): array
    {
        $fake = fake('id_ID');

        return [
            'id_akun' => self::$idKaryawanCounter,
            'id_guru' => self::$idKaryawanCounter++,
            'rencana_pelaksanaan_pembelajaran' => fake()->numberBetween(10, 100),
            'kriteria_ketuntasan_minimal' => fake()->numberBetween(10, 100),
            'pembuatan_soal' => fake()->numberBetween(10, 100),
            'absensi_kehadiran' => fake()->numberBetween(10, 100),
            'ketepatan_waktu' => fake()->numberBetween(10, 100),
        ];
    }
}
