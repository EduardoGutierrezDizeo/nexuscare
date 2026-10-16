<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\RolePermissionSeeder;

test('database seeder assigns administrator role to test user', function () {
    $this->seed(RolePermissionSeeder::class);
    $this->seed(DatabaseSeeder::class);

    $user = User::where('email', 'test@example.com')->firstOrFail();
    expect($user->hasRole('administrador'))->toBeTrue();
});
