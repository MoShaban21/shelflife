<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns a token with valid credentials and allows access to /api/user', function () {
    $user = User::factory()->create([
        'email' => 'member@example.com',
        'password' => 'password',
        'role' => 'member',
    ]);

    $loginResponse = $this->postJson('/api/login', [
        'email' => 'member@example.com',
        'password' => 'password',
    ]);

    $loginResponse
        ->assertOk()
        ->assertJsonStructure(['token', 'user']);

    $token = $loginResponse->json('token');

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson('/api/user')
        ->assertOk()
        ->assertJsonPath('email', 'member@example.com');
});

it('rejects protected endpoint without a token', function () {
    $this->getJson('/api/user')->assertUnauthorized();
});
