<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->text('6'),
            'quantity' => rand(1, 100),
            'thumb' => $this->faker->imageUrl(),
            'description' => $this->faker->text(),
            'active' => rand(0, 1),
            'discount' => rand(10, 20),
            'menu' => '1',
            'start_time' => date('YYYY-MM-DD : H:i:s'),
            'end_time' =>   date('YYYY-MM-DD HH:mm'),
        ];
    }
}
