<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'author_id' => factory(Author::class), // larwa utworzy autora tylko wtedy, jeśli nie ma na sztywno ustawionego w teście
    ];
});
