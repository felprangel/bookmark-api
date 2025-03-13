<?php

use App\Models\Book;
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

it('should return all books of the logger user withou page attribute', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );
    $this->seed(BookSeeder::class);

    $response = $this->get('/books');

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

    $response = $this->post('/books', $data);
    $response->assertOk();

    expect(Book::where('title', 'Clean Code')->exists())->toBeTrue();
});

it('should mark an book as read correctly', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $book = Book::factory()->unread()->create();

    $response = $this->patch("/books/{$book->id}/read", ['read' => true]);
    $response->assertOk();

    expect(Book::where('id', $book->id)->first()->read)->toBeTrue();
});

it('should mark an book as unread correctly', function () {
    Sanctum::actingAs(
        User::factory()->create()
    );

    $book = Book::factory()->create();

    $response = $this->patch("/books/{$book->id}/read", ['read' => false]);
    $response->assertOk();

    expect(Book::where('id', $book->id)->first()->read)->toBe(false);
});
