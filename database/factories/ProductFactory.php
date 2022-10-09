<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
            'content' => $this->faker->text,
            'thumb' => $this->faker->imageUrl($width = 200, $height = 200),
            'menu_id' => 1,
            'price_id' => 1,
            'active' => 1,
            'desc' => 'abc',
            'quantity' => $this->faker->numberBetween(10, 5000)

        ];
    }
}