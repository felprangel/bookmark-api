<?php

use App\Models\User;
use Database\Seeders\BookSeeder;

it('should return the correct books by user', function () {
    User::factory()->create();
    $this->seed(BookSeeder::class);
});
