<?php

use Illuminate\Support\Facades\Route;

Route::post('/books', 'BooksController@store');
Route::patch('/books/{book}', 'BooksController@update');
