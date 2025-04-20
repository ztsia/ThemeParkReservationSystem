<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'Indoor Theme Park Ticket',
            'description' => 'Enjoy a day of fun and excitement at our indoor theme park!',
            'image' => 'images/items/indoor.jpg', 
            'normalPrice' => 50.00, // Normal price
            'childrenSeniorPrice' => 30.00, // Children/Senior price
            'studentPrice' => 40.00, // Student price
        ]);
        Item::create([
            'name' => 'Outdoor Theme Park Ticket',
            'description' => 'Experience the thrill of our outdoor theme park rides!',
            'image' => 'images/items/outdoor.jpg', 
            'normalPrice' => 60.00, // Normal price
            'childrenSeniorPrice' => 35.00, // Children/Senior price
            'studentPrice' => 45.00, // Student price
        ]);
        Item::create([
            'name' => 'Water Park Ticket',
            'description' => 'Beat the heat with a day at our water park!',
            'image' => 'images/items/waterpark.jpg', 
            'normalPrice' => 55.00, // Normal price
            'childrenSeniorPrice' => 32.00, // Children/Senior price
            'studentPrice' => 42.00, // Student price
        ]);
    }
}
