<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class CheckoutBooksController extends Controller
{
    public function __constuct()
    {
        $this->middleware('auth');
    }

    public function store(Book $book)
    {
        $book->checkout(auth()->user());
    }
}
