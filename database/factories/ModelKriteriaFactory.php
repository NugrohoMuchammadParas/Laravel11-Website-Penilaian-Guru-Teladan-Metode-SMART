<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModelKriteriaFactory extends Factory
{
    private static $idKaryawanCounter = 1;

    public function definition(): array
    {
        $fake = fake('id_ID');

        return [
            'id_akun' => self::$idKaryawanCounter++,
            'kriteria' => fake()->randomElement(['Rencana Pelaksanaan Pembelajaran', 'Kriteria Ketuntasan Minimal', 'Pembuatan Soal', 'Absensi Kehadiran', 'Ketepatan Waktu']),
            'keterangan' => fake()->randomElement(['Benefit', 'Cost']),
            'bobot' => fake()->numberBetween(10, 50),
        ];
    }
}
