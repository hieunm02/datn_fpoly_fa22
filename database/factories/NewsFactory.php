<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'short_desc' => $this->faker->text(150),
            'image_path' => $this->faker->imageUrl(100, 100),
            'content' => $this->faker->text(),
            'view' => rand(1, 100),
            'user_id' => rand(1, 10),
            'active' => rand(1, 4),
        ];
    }
}
