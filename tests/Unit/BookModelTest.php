<?php

use App\Models\Book;
use App\Models\User;
use Database\Seeders\BookSeeder;
use Illuminate\Support\Facades\Auth;

it('should return the correct books by user', function () {
    $user = User::factory()->create();
    $this->seed(BookSeeder::class);

    Auth::login($user);

    $books = Book::getBooksByUser(1);

    expect($books)->toHaveCount(10);

    $books = Book::getBooksByUser(2);

    expect($books)->toHaveCount(5);
});
