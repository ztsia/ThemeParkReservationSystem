<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get existing user IDs from the database (non-admin) and exclude IDs 1 and 2
        $userIds = User::where('is_admin', 0)
                      ->whereNotIn('id', [1, 2]) // Exclude test users
                      ->pluck('id')
                      ->toArray();
        
        $itemIds = Item::pluck('id')->toArray();
        
        // Generate payment data
        $isPaid = $this->faker->boolean(70); // 70% chance of being paid
        $paymentDate = $isPaid ? $this->faker->dateTimeBetween('-1 week', 'now') : null;
        $paymentType = $isPaid ? $this->faker->randomElement(['Credit Card', 'Online Banking', 'Cash Payment']) : null;

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'item_id' => $this->faker->randomElement($itemIds),
            'ticket_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'quantity' => $this->faker->numberBetween(1, 5),
            'user_category' => $this->faker->randomElement(['Adult', 'Child', 'Senior', 'Student']),
            'payment_type' => $paymentType,
            'payment_date' => $paymentDate,
        ];
    }
}
