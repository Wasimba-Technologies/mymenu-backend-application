<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=> Role::ADMIN]);
        Role::create(['name'=> Role::CHEF]);
        Role::create(['name'=> Role::WAITER]);
        Role::create(['name'=> Role::CASHIER]);
    }
}
