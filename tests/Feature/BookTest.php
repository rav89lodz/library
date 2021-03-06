<?php

namespace Tests\Feature;

use App\Author;
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

        $response = $this->post('/books', $this->data());

        $book = Book::first();
        //$response->assertOk();
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', array_merge($this->data(), ['title' => '']));

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', $this->data());

        $book = Book::first(); // tutaj pobieramy zawartość Book do zmiennej

        $response = $this->patch($book->path(), [ // tutaj dajemy nowe dane
            'title' => 'New title',
            'author_id' => 'RC',
        ]);

        $this->assertEquals('New title', Book::first()->title);
        $this->assertEquals(22, Book::first()->author_id);
        $response->assertRedirect($book->fresh()->path()); // więc tutaj fresh, żeby odświeżyć Book z nowego response
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', $this->data());

        $book = Book::first();
        $this->assertCount(1, Book::all()); // sprawdzenie że książka jest w bazie i można ją usunąć

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books'); // po usunięciu idź do strony głównej
    }

    /** @test */
    public function a_new_author_is_auto_added()
    {
        $this->post('/books', $this->data());

        $book = Book::first();
        $author = Author::first();

        $this->assertCount(1, Author::all());
        $this->assertEquals($author->id, $book->author_id);
    }

    private function data()
    {
        return [
            'title' => 'Cool book title',
            'author_id' => '1',
        ];
    }
}
