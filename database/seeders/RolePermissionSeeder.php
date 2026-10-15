<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'ver tickets',
            'crear tickets',
            'gestionar tickets',
            'ver usuarios',
            'gestionar usuarios',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'web'])
            ->givePermissionTo(['ver tickets', 'crear tickets']);

        Role::firstOrCreate(['name' => 'agente', 'guard_name' => 'web'])
            ->givePermissionTo(['ver tickets', 'crear tickets', 'gestionar tickets']);

        Role::firstOrCreate(['name' => 'administrador', 'guard_name' => 'web'])
            ->givePermissionTo($permissions);
    }
}
