<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Author;
use Carbon\Carbon;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_author_can_be_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', $this->data());

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1989/11/04', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function the_name_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    public function the_dob_is_required()
    {
        $response = $this->post('/authors', array_merge($this->data(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    private function data()
    {
        return [
            'name' => 'Rafal',
            'dob' => '1989-04-11',
        ];
    }
}
