<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {    
        // $this->call(ClientSeeder::class);
        Permission::create(['name' => 'View Products List']);
        Permission::create(['name' => 'View Product']);
        Permission::create(['name' => 'Create Product']);
        Permission::create(['name' => 'Update Product']);
        Permission::create(['name' => 'Delete Product']);

        Permission::create(['name' => 'Create Sale']);

        Role::create(['name' => 'Super Admin']);
        $role = Role::create(['name' => 'Vendedor']);
        $role->givePermissionTo(Permission::all());
    }
}
