<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    // vendor/bin/phpunit                                   <= wszystkie testy
    // vendor/bin/phpunit --filter a_book_can_be_updated    <= pojedynczy test


     /** @test */
    public function a_book_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'RC',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

     /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'RC',
        ]);

        $response->assertSessionHasErrors('title');
    }

     /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool book title',
            'author' => 'RC',
        ]);

        $book_id = Book::first()->id;

        $response = $this->patch('/books/'.$book_id, [
            'title' => 'New title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
    }
}
