<?php

namespace Database\Seeders;

use App\Models\PetsitterAdvert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetsitterAdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PetsitterAdvert::factory()
            ->count(3)
            ->create();
    }
}
