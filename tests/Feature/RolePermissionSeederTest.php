<?php

use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

test('role permission seeder creates the initial roles', function () {
    $this->seed(RolePermissionSeeder::class);

    expect(Role::pluck('name')->all())
        ->toContain('cliente', 'agente', 'administrador');
});

test('administrator role has every permission', function () {
    $this->seed(RolePermissionSeeder::class);

    $administrator = Role::findByName('administrador');

    expect($administrator->permissions->pluck('name')->sort()->values()->all())
        ->toBe(Permission::pluck('name')->sort()->values()->all());
});

test('seeding twice does not duplicate roles or permissions', function () {
    $this->seed(RolePermissionSeeder::class);
    $this->seed(RolePermissionSeeder::class);

    expect(Role::count())->toBe(3)
        ->and(Permission::count())->toBe(5);
});
