<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory() -> create([
            'name' => 'Sia Zhong Tai',
            'password' => '123456789',
        ]);
        Admin::factory() -> count(5) -> create();
    }
}
