<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

it('should create an user correctly', function () {
    $data = [
        'name' => 'Test name',
        'email' => 'test@email.com',
        'password' => 'testPassword',
        'password_confirmation' => 'testPassword'
    ];
    Auth::shouldReceive('login')->once();
    $response = $this->post('/register', $data);

    $this->assertDatabaseHas('users', [
        'email' => 'test@email.com'
    ]);

    $response->assertExactJsonStructure(['token']);
    $response->assertOk();
});

it('should make login correctly', function () {
    User::factory()->create();
    $data = [
        'email' => 'test@email.com',
        'password' => 'testPassword'
    ];

    $response = $this->post('/login', $data);

    $response->assertExactJsonStructure(['token']);
    $response->assertOk();
});

it('should throw an error if try to make login with invalid credentials', function () {
    User::factory()->create();
    $data = [
        'email' => 'test@email.com',
        'password' => 'wrongPassword'
    ];

    $response = $this->post('/login', $data);

    $response->assertUnauthorized();
});

it('should logout the user correctly', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $response = $this->post('/logout');

    $response->assertOk();
});
