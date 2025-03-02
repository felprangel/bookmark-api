<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
    $response->assertStatus(Response::HTTP_OK);
});
