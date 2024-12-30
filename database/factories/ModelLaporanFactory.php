<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ModelLaporanFactory extends Factory
{
    private static $idguruCounter = 1;

    public function definition(): array
    {
        $fake = fake('id_ID');

        return [
            'id_akun' => self::$idguruCounter,
            'id_guru' => self::$idguruCounter++,
            'tanggal' => fake()->date(),
            'file' => fake()->text(20),
        ];
    }
}
