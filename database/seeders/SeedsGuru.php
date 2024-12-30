<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelGuru;

class SeedsGuru extends Seeder
{
    public function run(): void
    {
        ModelGuru::factory()->count(5)->create();
    }
}
