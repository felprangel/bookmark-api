<?php

use App\Models\User;
use Database\Seeders\BookSeeder;
use Laravel\Sanctum\Sanctum;

it('should return all books of the logger user', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );
    $this->seed(BookSeeder::class);

    $response = $this->get('/books?page=1');

    $response->assertOk();
});

it('should register an book correctly', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $data = [
        'title' => 'Clean Code',
        'author' => 'Robert C. Martin',
        'pages' => 431,
        'read' => false
    ];

    $response = $this->post('/book', $data);
    $response->assertOk();

    expect(User::where('title', 'Clean Code')->exists())->toBeTrue();
});
