<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;
use Database\Factories\Str;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(40),
            'picture' => 'example.jpg',
            'normalPrice' => $this->faker->numberBetween(10, 99), // Random number between 10-99
            'childrenSeniorPrice' => $this->faker->numberBetween(10, 99),
            'studentPrice' => $this->faker->numberBetween(10, 99),
        ];
    }
}

