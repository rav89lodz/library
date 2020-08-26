<?php

use Illuminate\Support\Facades\Route;

Route::post('/books', 'BooksController@store');
Route::patch('/books/{book}-{slug}', 'BooksController@update');
Route::delete('/books/{book}-{slug}', 'BooksController@destroy');

Route::post('/author', 'AuthorController@store');
Route::post('/checkout/{book}', 'CheckoutBooksController@store');
Route::post('/checkin/{book}', 'CheckinBooksController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
