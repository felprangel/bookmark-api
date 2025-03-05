<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
}
