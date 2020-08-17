<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    public function store()
    {
        Book::create($this->validateRequest());
    }

    public function update(Book $book)
    {
        $book->update($this->validateRequest());
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' =>'required|min:3',
            'author' => 'required|max:40',
        ]);
    }
}
