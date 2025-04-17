<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
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
            'image' => 'images/events/fireshow.jpg', // Default image path
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
