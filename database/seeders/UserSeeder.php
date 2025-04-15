<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory() -> create([
            'name' => 'User',
            'email' => 'user@test.com', 
            'password' => bcrypt('123456789'),
            'is_admin' => false,
        ]);
        User::factory() -> create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456789'),
            'is_admin' => true,
        ]);
        User::factory() -> count(50) -> create();
    }
}
