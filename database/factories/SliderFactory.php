<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'media_id' => MediaFactory::new()->create(),
            'order' => $this->faker->numberBetween(1, 10),
            'url' => $this->faker->url(),
            'status' => $this->faker->boolean(),
        ];
    }
}
