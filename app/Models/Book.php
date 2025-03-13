<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'author', 'pages', 'read'];

    protected function casts(): array
    {
        return [
            'read' => 'boolean',
        ];
    }

    public static function getBooksByUser(int $page)
    {
        $limit = $page * 10;
        $offset = ($page - 1) * 10;

        $books = DB::select(
            "SELECT
                books.id,
                books.title,
                books.author,
                books.pages,
                books.read
            FROM books
            WHERE books.user_id = :user_id
            LIMIT :limit
            OFFSET :offset",
            [
                'user_id' => Auth::id(),
                'limit' => $limit,
                'offset' => $offset
            ]
        );

        return $books;
    }
}
