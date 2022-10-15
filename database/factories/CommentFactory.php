<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(50),
            'user_id' => 1,
            'product_id' => 137,
            'parent_id' => null,
            'active' => 0,
        ];
    }
}