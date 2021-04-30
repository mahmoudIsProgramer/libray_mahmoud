<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->data());

        $book = Book::first();

        $this->assertCount(1, Book::all());
        // $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->data());

        $book = Book::first();

        $response = $this->patch('books/' . $book->id, array_merge($this->data(), ['title' => 'new mam']));
        $this->assertEquals('new mam', Book::first()->title);
    }

    /** @test */
    public function a_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', array_merge($this->data(), ['title' => '']));

        $response->assertSessionHasErrors('title');
    }

    private function data()
    {
        return [
            'title' => 'Cool Book Title',
            'author_id' => 'Victor',
        ];
    }
}
