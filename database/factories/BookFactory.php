<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => Str::random(20),
            'author' => Str::random(20),
            'pages' => random_int(0, 500),
            'read' => true
        ];
    }

    public function unread(): Factory
    {
        return $this->state(function () {
            return [
                'read' => false,
            ];
        });
    }
}
