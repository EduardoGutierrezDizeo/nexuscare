<?php

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

test('client is forbidden from the user management section', function () {
    $client = User::factory()->create(['email_verified_at' => now()])->assignRole('cliente');

    $this->actingAs($client)
        ->get(route('users.index'))
        ->assertForbidden();
});

test('agent is forbidden from the user management section', function () {
    $agent = User::factory()->create(['email_verified_at' => now()])->assignRole('agente');

    $this->actingAs($agent)
        ->get(route('users.index'))
        ->assertForbidden();
});

test('administrator can access the user management section', function () {
    $admin = User::factory()->create(['email_verified_at' => now()])->assignRole('administrador');

    $this->actingAs($admin)
        ->get(route('users.index'))
        ->assertOk();
});

test('unverified user is redirected to email verification from users index', function () {
    $admin = User::factory()->unverified()->create()->assignRole('administrador');

    $this->actingAs($admin)
        ->get(route('users.index'))
        ->assertRedirect(route('verification.notice'));
});
