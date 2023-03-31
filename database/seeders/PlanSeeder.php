<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Kitonga',
            'menu_items' => 10,
            'orders' => 20,
            'views' => 40,
            'users' => 2,
            'dedicated_support' => false,
            'price' => 0
        ]);

        Plan::create([
            'name' => 'Usambara',
            'menu_items' => -1,
            'orders' => 200,
            'views' => -1,
            'users' => 3,
            'dedicated_support' => true,
            'price' => 250000
        ]);

        Plan::create([
            'name' => 'Kilimanjaro',
            'menu_items' => -1,
            'orders' => -1,
            'views' => -1,
            'users' => 5,
            'dedicated_support' => true,
            'price' => 350000
        ]);
    }
}
