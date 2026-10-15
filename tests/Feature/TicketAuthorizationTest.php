<?php

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;

beforeEach(function () {
    $this->seed(RolePermissionSeeder::class);
});

test('client is forbidden from the ticket management route', function () {
    $client = User::factory()->create()->assignRole('cliente');

    $this->actingAs($client)
        ->get(route('tickets.manage'))
        ->assertForbidden();
});

test('agent can access the ticket management route', function () {
    $agent = User::factory()->create()->assignRole('agente');

    $this->actingAs($agent)
        ->get(route('tickets.manage'))
        ->assertOk();
});

test('client can access the ticket listing', function () {
    $client = User::factory()->create()->assignRole('cliente');

    $this->actingAs($client)
        ->get(route('tickets.index'))
        ->assertOk();
});

test('administrator can access every ticket route', function (string $route) {
    $admin = User::factory()->create()->assignRole('administrador');

    $this->actingAs($admin)
        ->get(route($route))
        ->assertOk();
})->with(['tickets.index', 'tickets.create', 'tickets.manage']);
