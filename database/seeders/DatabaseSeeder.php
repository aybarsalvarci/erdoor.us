<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            DoorSeeder::class,
            PageSeeder::class,
            SettingSeeder::class,
            MediaSeeder::class,
            SliderSeeder::class,
            ResourcePagesSeeder::class,
            HomePageSeeder::class,
            WhyWpcPageSeeder::class,
            AboutPageSeeder::class,
            ContactPageSeeder::class,
        ]);
    }
}
