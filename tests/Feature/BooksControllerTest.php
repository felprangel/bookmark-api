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
    $response->assertJson();
});
