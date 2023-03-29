<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.delete']);

        Permission::create(['name' => 'menus.view']);
        Permission::create(['name' => 'menus.create']);
        Permission::create(['name' => 'menus.update']);
        Permission::create(['name' => 'menus.delete']);

        Permission::create(['name' => 'menu_items.view']);
        Permission::create(['name' => 'menu_items.create']);
        Permission::create(['name' => 'menu_items.update']);
        Permission::create(['name' => 'menu_items.delete']);

        Permission::create(['name' => 'tables.view']);
        Permission::create(['name' => 'tables.create']);
        Permission::create(['name' => 'tables.update']);
        Permission::create(['name' => 'tables.delete']);

        Permission::create(['name' => 'qr_codes.view']);
        Permission::create(['name' => 'qr_codes.create']);
        Permission::create(['name' => 'qr_codes.update']);
        Permission::create(['name' => 'qr_codes.delete']);



        Permission::create(['name' => 'orders.view']);
        Permission::create(['name' => 'orders.create']);
        Permission::create(['name' => 'orders.update']);
        Permission::create(['name' => 'orders.delete']);

        Permission::create(['name' => 'orders.view']);
        Permission::create(['name' => 'orders.create']);
        Permission::create(['name' => 'orders.update']);
        Permission::create(['name' => 'orders.delete']);

        Permission::create(['name' => 'payments.view']);
        Permission::create(['name' => 'payments.create']);
        Permission::create(['name' => 'payments.update']);
        Permission::create(['name' => 'payments.delete']);

        Permission::create(['name' => 'plans.view']);
        Permission::create(['name' => 'plans.create']);
        Permission::create(['name' => 'plans.update']);
        Permission::create(['name' => 'plans.delete']);

        Permission::create(['name' => 'restaurants.view']);
        Permission::create(['name' => 'restaurants.create']);
        Permission::create(['name' => 'restaurants.update']);
        Permission::create(['name' => 'restaurants.delete']);
    }
}
