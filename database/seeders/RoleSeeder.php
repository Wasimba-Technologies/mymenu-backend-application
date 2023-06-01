<?php

namespace Database\Seeders;

use App\Models\Permission;
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
        $super_admin = Role::create(['name' => 'SuperAdmin']);
        $super_admin->permissions()->attach(Permission::pluck('id'));

        $admin = Role::create(['name'=> 'Admin']);
        $admin->permissions()->attach(
            Permission::where('name', '!=', 'restaurants.viewAny')->pluck('id'),
        );

        $chef = Role::create(['name'=> 'Chef']);
        $chef->permissions()->attach([
            Permission::where('name', '=', 'menus.viewAny')->first('id')->id,
            Permission::where('name', '=', 'menus.view')->first('id')->id,
            Permission::where('name', '=', 'menus.create')->first('id')->id,
            Permission::where('name', '=', 'menus.update')->first('id')->id,
            Permission::where('name', '=', 'menu_items.viewAny')->first('id')->id,
            Permission::where('name', '=', 'menu_items.view')->first('id')->id,
            Permission::where('name', '=', 'menu_items.create')->first('id')->id,
            Permission::where('name', '=', 'menu_items.update')->first('id')->id,
            Permission::where('name', '=', 'orders.viewAny')->first('id')->id,
            Permission::where('name', '=', 'orders.view')->first('id')->id,
            Permission::where('name', '=', 'orders.update')->first('id')->id,
            Permission::where('name', '=', 'users.update')->first('id')->id,
        ]);

        $waiter = Role::create(['name'=> 'Waiter']);
        $waiter->permissions()->attach([
            Permission::where('name', '=', 'menus.viewAny')->first('id')->id,
            Permission::where('name', '=', 'menus.view')->first('id')->id,
            Permission::where('name', '=', 'menu_items.viewAny')->first('id')->id,
            Permission::where('name', '=', 'menu_items.view')->first('id')->id,
            Permission::where('name', '=', 'tables.viewAny')->first('id')->id,
            Permission::where('name', '=', 'tables.create')->first('id')->id,
            Permission::where('name', '=', 'tables.delete')->first('id')->id,
            Permission::where('name', '=', 'orders.viewAny')->first('id')->id,
            Permission::where('name', '=', 'orders.view')->first('id')->id,
            Permission::where('name', '=', 'users.update')->first('id')->id,
        ]);

        $cashier = Role::create(['name'=> 'Cashier']);
        $cashier->permissions()->attach([
            Permission::where('name', '=', 'menus.viewAny')->first('id')->id,
            Permission::where('name', '=', 'menus.view')->first('id')->id,
            Permission::where('name', '=', 'menu_items.viewAny')->first('id')->id,
            Permission::where('name', '=', 'orders.viewAny')->first('id')->id,
            Permission::where('name', '=', 'orders.view')->first('id')->id,
            Permission::where('name', '=', 'orders.update')->first('id')->id,
            Permission::where('name', '=', 'users.update')->first('id')->id,
        ]);
    }
}
