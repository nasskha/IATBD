<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $users->each(function ($user) {
            $user->pets()->saveMany(
                Pet::factory()
                    ->count(2)
                    ->create()
            );
        });

        Pet::create([
            'name' => 'Woeffie',
            'type' => 'dog',
            'breed' => 'poodle',
            'age' => 3,
            'user_id' => 1,
            'hourly_rate' => 10,
            'description' => "Mijn hele lieve hondje zoekt een tijdelijk baasje!! \nWoeffie eet 1 keer per dag brokjes en 1 keer natvoer.\n\nPas jij op mijn lieve Woeffie????\n\nGroetjes Billie",
            'city' => 'Amsterdam',
            'begin_date' => now()->addDays(2),
            'end_date' => now()->addDays(9),
            'advert_active' => true,
        ]);

    }
}
