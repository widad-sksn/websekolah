<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = \Spatie\Permission\Models\Role::create(['name' => 'Super Admin']);
        $adminSekolah = \Spatie\Permission\Models\Role::create(['name' => 'Admin Sekolah']);
        $editor = \Spatie\Permission\Models\Role::create(['name' => 'Editor']);

        // Create default Super Admin
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Administrator',
            'email' => 'admin@schoolcms.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($superAdmin);
    }
}
