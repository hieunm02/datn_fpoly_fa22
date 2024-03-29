<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'product_id' => rand(220, 300),
            'thumb' => $this->faker->imageUrl(),
            'active' => rand(0, 1)
        ];
    }
}
