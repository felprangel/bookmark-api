<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($index = 0; $index < 15; $index++) {
            DB::table('books')->insert([
                'user_id' => 1,
                'title' => Str::random(20),
                'author' => Str::random(20),
                'pages' => random_int(0, 500),
                'read' => random_int(0, 1)
            ]);
        }
    }
}
