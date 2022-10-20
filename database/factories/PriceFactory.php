<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'original' => $this->faker->randomFloat(2, 10, 100),
            'sale' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
