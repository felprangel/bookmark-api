<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

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
    $data = [
        'email' => 'test@email.com',
        'password' => 'testPassword'
    ];

    Auth::partialMock()->shouldReceive('attempt')->with($data);
    $response = $this->post('/login', $data);

    $response->assertOk();
});
