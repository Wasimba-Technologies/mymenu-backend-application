<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating a super admin user: This is a user that manages all tenants in this application
        $this->createSuperAdmin();
    }

    /**
     * @return void
     */
    private function createSuperAdmin(): void
    {
        $superAdminRole = Role::where(['name' => 'SuperAdmin'])->first();
        $superAdminRole->users()->create(
            [
                'name' => 'Super Admin',
                'email' => 'super.admin@mymenu.com',
                'gender' => 'M',
                'phone_number' => '0700000000',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                'password' => Hash::make('password')
            ]
        );
    }


}
