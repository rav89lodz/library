<?php

namespace Tests\Unit;

use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class AuthorTestUnit extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_dob_is_nullable()
    {
        Author::firstOrCreate([
            'name' => 'John Doe',
        ]);

        $this->assertCount(1, Author::all());
    }
}
