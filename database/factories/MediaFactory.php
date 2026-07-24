<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alt_text' => $this->faker->sentence(),
            'path' => 'https://picsum.photos/seed/' . fake()->uuid() . '/640/480',
            'type' => 'external'
        ];
    }
}
