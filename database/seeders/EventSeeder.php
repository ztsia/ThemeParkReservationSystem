<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => 'Fire Show',
            'description' => 'Experience the thrill of our magical fire show!',
            'image' => 'images/events/fireshow.jpg',
            'date' => now()->addDays(7), // Event date
        ]);
        Event::create([
            'name' => 'Family Day',
            'description' => 'Join us for a fun-filled family day with games and activities for all ages!',
            'image' => 'images/events/familyday.jpg', 
            'date' => now()->addDays(14), // Event date
        ]);
    }
}
