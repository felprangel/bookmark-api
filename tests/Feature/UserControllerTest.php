<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
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
    $this->seed(UserSeeder::class);
    $data = [
        'email' => 'test@email.com',
        'password' => 'testPassword'
    ];

    $response = $this->post('/login', $data);

    $response->assertExactJsonStructure(['token']);
    $response->assertOk();
});

it('should throw an error if try to make login with invalid credentials', function () {
    $this->seed(UserSeeder::class);
    $data = [
        'email' => 'test@email.com',
        'password' => 'wrongPassword'
    ];

    $response = $this->post('/login', $data);

    $response->assertUnauthorized();
});

it('should logout the user correctly', function () {
    // TODO: Trocar seeder por factory de usuário
    // TODO: Usar o método do actingAs do Sanctum para testes
    $this->seed(UserSeeder::class);
    $user = User::find(1);
    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => "Bearer $token"
    ])->post('/logout');

    $response->assertOk();
});
