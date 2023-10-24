<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
{
    Permission::create(['name' => 'add']);
    Permission::create(['name' => 'update']);
    Permission::create(['name' => 'show']);
    Permission::create(['name' => 'delete']);

    $role = Role::create(['name' => 'admin']);
    $role->givePermissionTo(['add', 'show', 'update', 'delete']);

    \App\Models\User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'admin@admin.com',
        'password' => '$2y$10$qCsQvAhKdYgTBIFOXDuLfeh42w11g/EgASMOuOB74Fr8gaVhfJC0i',  // password
        'role'  =>  'admin',
    ])->assignRole('admin');
}

}
