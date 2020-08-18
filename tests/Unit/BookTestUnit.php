<?php

namespace Tests\Unit;

use App\Author;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class BookTestUnit extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_author_id_is_recorded()
    {
        Book::create([
            'title' => 'cool title',
            'author_id' => 1,
        ]);

        $this->assertCount(1, Book::all());
    }
}
