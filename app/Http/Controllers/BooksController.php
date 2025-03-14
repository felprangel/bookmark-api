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
            'page' => ['integer']
        ]);

        $books = Book::getBooksByUser($data['page'] ?? 1);
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
        $book->save();
    }

    public function readBook(int $bookId)
    {
        $data = Request::validate([
            'read' => ['required', 'boolean']
        ]);

        $book = Book::find($bookId);
        $book->read = $data['read'];
        $book->save();
    }

    public function deleteBook(int $bookId)
    {
        $book = Book::find($bookId);
        $book->delete();
    }
}
