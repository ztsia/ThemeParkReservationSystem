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
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'image' => 'images/items/themepark.jpg', // Default image path
            'normalPrice' => $this->faker->randomFloat(2, 1, 100), // Random price between 1 and 100
            'childrenSeniorPrice' => $this->faker->randomFloat(2, 1, 100), // Random price between 1 and 100
            'studentPrice' => $this->faker->randomFloat(2, 1, 100), // Random price between 1 and 100
        ];
    }
}
