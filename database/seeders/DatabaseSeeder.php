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
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789_123456789_test'),
            'is_admin' => true,
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
