<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class BooksController
{
    public function getUserBooks()
    {
        $data = Request::validate([
            'page' => ['required', 'integer']
        ]);

        $books = Book::getBooksByUser($data['page']);
        return $books;
    }

    public function registerBook()
    {
        $data = Request::validate([
            'title' => ['required', 'string'],
            'author' => ['required', 'string'],
            'pages' => ['required', 'integer'],
            'read' => ['required', 'boolean']
        ]);

        $book = new Book($data);
        $book->user_id = Auth::id();
        $book->save;
    }
}
